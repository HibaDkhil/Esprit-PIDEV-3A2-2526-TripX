<?php

namespace App\Controller\admin;

use App\Entity\Room;
use App\Entity\RoomImages;
use App\Repository\AccommodationRepository;
use App\Repository\RoomRepository;
use App\Repository\RoomImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\service\Accommodation\RoomInsightsService;

#[Route('/admin/accommodations/{accId}/rooms', name: 'admin_rooms_')]
class RoomController extends AbstractController
{
    public function __construct(
        private AccommodationRepository $accRepo,
        private RoomRepository $roomRepo,
        private RoomImagesRepository $imgRepo,
        private EntityManagerInterface $em
    ) {}

    // ── Room list page ────────────────────────────────────────────────
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(int $accId): Response
    {
        $acc = $this->accRepo->find($accId);
        if (!$acc) throw $this->createNotFoundException('Accommodation not found');

        $rooms = $this->roomRepo->findBy(['accommodation' => $acc], ['id' => 'ASC']);

        // Attach primary image to each room
        $roomsData = array_map(function(Room $r) {
            $primaryImg = $this->imgRepo->findOneBy(['room' => $r, 'isPrimary' => true])
                       ?? $this->imgRepo->findOneBy(['room' => $r], ['displayOrder' => 'ASC']);
            $allImages  = $this->imgRepo->findBy(['room' => $r], ['displayOrder' => 'ASC']);
            return [
                'room'        => $r,
                'primaryImg'  => $primaryImg,
                'allImages'   => $allImages,
                'imageCount'  => count($allImages),
            ];
        }, $rooms);

        return $this->render('admin/rooms.html.twig', [
            'acc'       => $acc,
            'roomsData' => $roomsData,
            'total'     => count($rooms),
            'available' => count(array_filter($rooms, fn($r) => $r->isAvailable())),
        ]);
    }

    // ── List (AJAX for modal preview) ─────────────────────────────────
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(int $accId): JsonResponse
    {
        $acc = $this->accRepo->find($accId);
        if (!$acc) return $this->json(['rooms' => []]);

        $rooms = $this->roomRepo->findBy(['accommodation' => $acc], ['id' => 'ASC']);

        $data = array_map(function(Room $r) {
            $primaryImg = $this->imgRepo->findOneBy(['room' => $r, 'isPrimary' => true])
                       ?? $this->imgRepo->findOneBy(['room' => $r], ['displayOrder' => 'ASC']);
            return [
                'id'            => $r->getId(),
                'roomName'      => $r->getRoomName(),
                'roomType'      => $r->getRoomType(),
                'pricePerNight' => $r->getPricePerNight(),
                'capacity'      => $r->getCapacity(),
                'size'          => $r->getSize(),
                'isAvailable'   => $r->isAvailable(),
                'primaryImage'  => $primaryImg?->getFilePath(),
            ];
        }, $rooms);

        return $this->json(['rooms' => $data]);
    }

    // ── Create room (UPDATED with validation) ─────────────────────────
    #[Route('/new', name: 'new', methods: ['POST'])]
    public function new(int $accId, Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $acc = $this->accRepo->find($accId);
            if (!$acc) return $this->json(['error' => 'Accommodation not found'], 404);

            $data = $request->request->all();
            $room = new Room();
            $room->setAccommodation($acc);
            $this->hydrateRoom($room, $data);

            // VALIDATION
            $errors = $validator->validate($room);
            
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $field = $error->getPropertyPath();
                    $errorMessages[$field] = $error->getMessage();
                }
                
                return $this->json([
                    'success' => false,
                    'errors' => $errorMessages,
                    'message' => 'Validation failed'
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->em->persist($room);
            $this->em->flush();

            // Handle image uploads - FIXED to handle multiple files properly
            $allFiles = $request->files->all();
            $images = [];
            
            // Properly collect all files from the request
            foreach ($allFiles as $key => $value) {
                if (is_array($value)) {
                    // Handle multiple files with same key (images[])
                    foreach ($value as $file) {
                        if ($file && $file->isValid()) {
                            $images[] = $file;
                        }
                    }
                } elseif ($value && $value->isValid()) {
                    $images[] = $value;
                }
            }
            
            if (!empty($images)) {
                $this->handleImageUploads($room, $images, true);
            }

            return $this->json(['success' => true, 'id' => $room->getId(), 'message' => 'Room created successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── View room (AJAX) ──────────────────────────────────────────────
    #[Route('/{roomId}', name: 'view', methods: ['GET'], requirements: ['roomId' => '\d+'])]
    public function view(int $accId, int $roomId): JsonResponse
    {
        $room = $this->roomRepo->find($roomId);
        if (!$room) return $this->json(['error' => 'Not found'], 404);

        $images = $this->imgRepo->findBy(['room' => $room], ['displayOrder' => 'ASC']);

        return $this->json([
            'id'            => $room->getId(),
            'roomName'      => $room->getRoomName(),
            'roomType'      => $room->getRoomType(),
            'pricePerNight' => $room->getPricePerNight(),
            'capacity'      => $room->getCapacity(),
            'size'          => $room->getSize(),
            'amenities'     => $room->getAmenities(),
            'isAvailable'   => $room->isAvailable(),
            'images'        => array_map(fn($img) => [
                'id'        => $img->getId(),
                'filePath'  => $img->getFilePath(),
                'fileName'  => $img->getFileName(),
                'isPrimary' => $img->isPrimary(),
                'order'     => $img->getDisplayOrder(),
            ], $images),
        ]);
    }

    // ── Edit room (UPDATED with validation) ───────────────────────────
    #[Route('/{roomId}/edit', name: 'edit', methods: ['POST'], requirements: ['roomId' => '\d+'])]
    public function edit(int $accId, int $roomId, Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $room = $this->roomRepo->find($roomId);
            if (!$room) return $this->json(['error' => 'Not found'], 404);

            $data = $request->request->all();
            $this->hydrateRoom($room, $data);

            // VALIDATION
            $errors = $validator->validate($room);
            
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $field = $error->getPropertyPath();
                    $errorMessages[$field] = $error->getMessage();
                }
                
                return $this->json([
                    'success' => false,
                    'errors' => $errorMessages,
                    'message' => 'Validation failed'
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->em->flush();

            // Handle new image uploads - FIXED to handle multiple files properly
            $allFiles = $request->files->all();
            $images = [];
            
            // Properly collect all files from the request
            foreach ($allFiles as $key => $value) {
                if (is_array($value)) {
                    // Handle multiple files with same key (images[])
                    foreach ($value as $file) {
                        if ($file && $file->isValid()) {
                            $images[] = $file;
                        }
                    }
                } elseif ($value && $value->isValid()) {
                    $images[] = $value;
                }
            }
            
            if (!empty($images)) {
                $this->handleImageUploads($room, $images, false);
            }

            return $this->json(['success' => true, 'message' => 'Room updated successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Delete room ───────────────────────────────────────────────────
    #[Route('/{roomId}/delete', name: 'delete', methods: ['POST'], requirements: ['roomId' => '\d+'])]
    public function delete(int $accId, int $roomId): JsonResponse
    {
        try {
            $room = $this->roomRepo->find($roomId);
            if (!$room) return $this->json(['error' => 'Not found'], 404);

            // Delete image files
            $images = $this->imgRepo->findBy(['room' => $room]);
            foreach ($images as $img) {
                $path = $this->getParameter('kernel.project_dir') . '/public/' . ltrim($img->getFilePath(), '/');
                if (file_exists($path)) unlink($path);
                $this->em->remove($img);
            }

            $this->em->remove($room);
            $this->em->flush();

            return $this->json(['success' => true, 'message' => 'Room deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Upload images (FIXED to handle multiple files) ────────────────────────────────
    #[Route('/{roomId}/images/upload', name: 'images_upload', methods: ['POST'], requirements: ['roomId' => '\d+'])]
    public function uploadImages(int $accId, int $roomId, Request $request): JsonResponse
    {
        try {
            $room = $this->roomRepo->find($roomId);
            if (!$room) return $this->json(['error' => 'Not found'], 404);

            // Collect all uploaded files regardless of key name
            $images = [];
            $allFiles = $request->files->all();
            
            foreach ($allFiles as $key => $value) {
                if (is_array($value)) {
                    // Handle multiple files with same key (images[])
                    foreach ($value as $file) {
                        if ($file && $file->isValid()) {
                            $images[] = $file;
                        }
                    }
                } elseif ($value && $value->isValid()) {
                    $images[] = $value;
                }
            }

            if (empty($images)) {
                return $this->json(['error' => 'No images provided'], 400);
            }

            $uploaded = $this->handleImageUploads($room, $images, false);

            return $this->json(['success' => true, 'message' => count($uploaded) . ' image(s) uploaded', 'images' => $uploaded]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Set primary image ─────────────────────────────────────────────
    #[Route('/{roomId}/images/{imgId}/primary', name: 'images_primary', methods: ['POST'], requirements: ['roomId' => '\d+', 'imgId' => '\d+'])]
    public function setPrimary(int $accId, int $roomId, int $imgId): JsonResponse
    {
        try {
            $room = $this->roomRepo->find($roomId);
            if (!$room) return $this->json(['error' => 'Not found'], 404);

            // Unset all primary
            $images = $this->imgRepo->findBy(['room' => $room]);
            foreach ($images as $img) $img->setIsPrimary(false);

            // Set new primary
            $img = $this->imgRepo->find($imgId);
            if ($img) $img->setIsPrimary(true);

            $this->em->flush();
            return $this->json(['success' => true, 'message' => 'Primary image updated']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Delete image ──────────────────────────────────────────────────
    #[Route('/{roomId}/images/{imgId}/delete', name: 'images_delete', methods: ['POST'], requirements: ['roomId' => '\d+', 'imgId' => '\d+'])]
    public function deleteImage(int $accId, int $roomId, int $imgId): JsonResponse
    {
        try {
            $img = $this->imgRepo->find($imgId);
            if (!$img) return $this->json(['error' => 'Not found'], 404);

            $path = $this->getParameter('kernel.project_dir') . '/public/' . ltrim($img->getFilePath(), '/');
            if (file_exists($path)) unlink($path);

            $this->em->remove($img);
            $this->em->flush();

            return $this->json(['success' => true, 'message' => 'Image deleted']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Reorder images ────────────────────────────────────────────────
    #[Route('/{roomId}/images/reorder', name: 'images_reorder', methods: ['POST'], requirements: ['roomId' => '\d+'])]
    public function reorderImages(int $accId, int $roomId, Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $order = $data['order'] ?? [];
            foreach ($order as $idx => $imgId) {
                $img = $this->imgRepo->find($imgId);
                if ($img) $img->setDisplayOrder($idx);
            }
            $this->em->flush();
            return $this->json(['success' => true]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── AI Room Insights ────────────────────────────────────────────────
    #[Route('/insights', name: 'insights', methods: ['GET'])]
    public function insights(int $accId, RoomInsightsService $insightsService): JsonResponse
    {
        $acc = $this->accRepo->find($accId);
        if (!$acc) {
            return $this->json(['error' => 'Accommodation not found'], 404);
        }

        $rooms = $this->roomRepo->findBy(['accommodation' => $acc]);
        $analysis = $insightsService->analyzeRooms($rooms);
        
        return $this->json($analysis);
    }

    // ── Helpers ───────────────────────────────────────────────────────
    private function hydrateRoom(Room $room, array $data): void
    {
        if (array_key_exists('roomName', $data))      $room->setRoomName($data['roomName']);
        if (array_key_exists('roomType', $data))      $room->setRoomType($data['roomType']);
        if (array_key_exists('pricePerNight', $data)) $room->setPricePerNight((float)$data['pricePerNight']);
        if (array_key_exists('capacity', $data))      $room->setCapacity((int)$data['capacity']);
        if (array_key_exists('size', $data))          $room->setSize($data['size'] ?: null);
        if (array_key_exists('amenities', $data))     $room->setAmenities($data['amenities']);
        if (array_key_exists('isAvailable', $data))   $room->setIsAvailable((bool)$data['isAvailable']);
    }

    private function handleImageUploads(Room $room, array $files, bool $firstIsPrimary): array
    {
        $dir = $this->getParameter('kernel.project_dir') . '/public/uploads/images/rooms';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $existingCount = $this->imgRepo->count(['room' => $room]);
        $uploaded = [];
        
        // Only set first image as primary if $firstIsPrimary is true AND there were no existing images
        $shouldSetPrimary = $firstIsPrimary && $existingCount === 0;

        foreach ($files as $i => $file) {
            if (!$file || !$file->isValid()) continue;

            // Get metadata BEFORE moving
            $originalName = $file->getClientOriginalName();
            $mimeType     = $file->getMimeType() ?? 'image/jpeg';
            $fileSize     = $file->getSize();
            $extension    = $file->guessExtension() ?? 'jpg';

            // Get dimensions BEFORE moving
            $tmpPath      = $file->getRealPath();
            [$w, $h]      = @getimagesize($tmpPath) ?: [null, null];

            $filename = uniqid() . '.' . $extension;
            $file->move($dir, $filename);
            $filePath = '/uploads/images/rooms/' . $filename;

            $img = new RoomImages();
            $img->setRoom($room);
            $img->setFileName($filename);
            $img->setFilePath($filePath);
            $img->setMimeType($mimeType);
            $img->setFileSizeBytes($fileSize);
            $img->setWidth($w);
            $img->setHeight($h);
            // Set isPrimary only for the first image if there were no existing images
            $img->setIsPrimary($shouldSetPrimary && $i === 0);
            $img->setDisplayOrder($existingCount + $i);
            $img->setCreatedAt(new \DateTime());
            $img->setUpdatedAt(new \DateTime());

            $this->em->persist($img);
            $uploaded[] = ['filePath' => $filePath, 'fileName' => $filename, 'id' => $img->getId()];
        }

        $this->em->flush();
        return $uploaded;
    }
}