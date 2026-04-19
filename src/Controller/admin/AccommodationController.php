<?php

namespace App\Controller\admin;

use App\Entity\Accommodation;
use App\Repository\AccommodationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/admin/accommodations', name: 'admin_accommodations_')]
class AccommodationController extends AbstractController
{
    public function __construct(
        private AccommodationRepository $repo,
        private EntityManagerInterface $em
    ) {}

    // ── List ─────────────────────────────────────────────────────────
#[Route('', name: 'index', methods: ['GET'])]
public function index(Request $request): Response
{
    $search = $request->query->get('search', '');
    $type   = $request->query->get('type', '');
    $status = $request->query->get('status', '');

    $accommodations = $this->repo->findByFilters($search, $type, $status);
    $stats          = $this->repo->getStats();
    $types          = $this->repo->findDistinctTypes();

    return $this->render('admin/accommodations.html.twig', [
        'accommodations' => $accommodations,
        'total'          => $stats['total'],
        'active'         => $stats['active'],
        'inactive'       => $stats['inactive'],
        'types'          => $types,
        'filters'        => compact('search', 'type', 'status'),
    ]);
}
    // ── Stats (AJAX) ─────────────────────────────────────────────────
#[Route('/stats', name: 'stats', methods: ['GET'])]
public function stats(): JsonResponse
{
    return $this->json($this->repo->getStats());
}

   // ── Search (AJAX real-time) ──────────────────────────────────────
#[Route('/search', name: 'search', methods: ['GET'])]
public function search(Request $request): JsonResponse
{
    $search  = $request->query->get('q', '');
    $type    = $request->query->get('type', '');
    $status  = $request->query->get('status', '');

    $results = $this->repo->findByFilters($search, $type, $status);

    $data = array_map(fn($a) => [
        'id'        => $a->getId(),
        'name'      => $a->getName(),
        'type'      => $a->getType(),
        'city'      => $a->getCity(),
        'country'   => $a->getCountry(),
        'stars'     => $a->getStars(),
        'rating'    => $a->getRating(),
        'status'    => $a->getStatus(),
        'imagePath' => $a->getImagePath(),
        'email'     => $a->getEmail(),
    ], $results);

    return $this->json(['results' => $data, 'count' => count($data)]);
}

    // ── View ────────────────────────────────────────────────────────
    #[Route('/{id}', name: 'view', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function view(int $id): JsonResponse
    {
        $a = $this->repo->find($id);
        if (!$a) return $this->json(['error' => 'Not found'], 404);

        return $this->json([
            'id'          => $a->getId(),
            'name'        => $a->getName(),
            'type'        => $a->getType(),
            'city'        => $a->getCity(),
            'country'     => $a->getCountry(),
            'address'     => $a->getAddress(),
            'postalCode'  => $a->getPostalCode(),
            'stars'       => $a->getStars(),
            'rating'      => $a->getRating(),
            'status'      => $a->getStatus(),
            'description' => $a->getDescription(),
            'phone'       => $a->getPhone(),
            'email'       => $a->getEmail(),
            'website'     => $a->getWebsite(),
            'latitude'    => $a->getLatitude(),
            'longitude'   => $a->getLongitude(),
            'imagePath'   => $a->getImagePath(),
            'amenities'   => $a->getAccommodationAmenities(),
            'createdAt'   => $a->getCreatedAt()?->format('Y-m-d H:i'),
        ]);
    }

    // ── Create (UPDATED with validation) ──────────────────────────────────────
    #[Route('/new', name: 'new', methods: ['POST'])]
    public function new(Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $data = $request->request->all();

            $a = new Accommodation();
            $this->hydrate($a, $data);
            $a->setCreatedAt(new \DateTime());
            $a->setUpdatedAt(new \DateTime());

            // VALIDATION
            $errors = $validator->validate($a);
            
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

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $type    = strtolower($data['type'] ?? 'hotels');
                $folder  = match($type) {
                    'villa'       => 'villas',
                    'apartment'   => 'apartments',
                    'resort', 'boutique', 'hostel', 'motel', 'guest house' => 'hotels',
                    default       => 'hotels',
                };
                $dir = $this->getParameter('kernel.project_dir') . '/public/uploads/images/' . $folder;
                if (!is_dir($dir)) mkdir($dir, 0777, true);
                $filename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($dir, $filename);
                $a->setImagePath('uploads/images/' . $folder . '/' . $filename);
            }

            $this->em->persist($a);
            $this->em->flush();

            return $this->json(['success' => true, 'id' => $a->getId(), 'message' => 'Accommodation created successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Update (UPDATED with validation) ──────────────────────────────────────
    #[Route('/{id}/edit', name: 'edit', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function edit(int $id, Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $a = $this->repo->find($id);
            if (!$a) return $this->json(['error' => 'Not found'], 404);

            $data = $request->request->all();
            $this->hydrate($a, $data);
            $a->setUpdatedAt(new \DateTime());

            // VALIDATION
            $errors = $validator->validate($a);
            
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

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $type    = strtolower($data['type'] ?? $a->getType() ?? 'hotels');
                $folder  = match($type) {
                    'villa'       => 'villas',
                    'apartment'   => 'apartments',
                    'resort', 'boutique', 'hostel', 'motel', 'guest house' => 'hotels',
                    default       => 'hotels',
                };
                $dir = $this->getParameter('kernel.project_dir') . '/public/uploads/images/' . $folder;
                if (!is_dir($dir)) mkdir($dir, 0777, true);
                $filename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($dir, $filename);
                
                // Delete old image if exists
                if ($a->getImagePath()) {
                    $oldPath = $this->getParameter('kernel.project_dir') . '/public/' . $a->getImagePath();
                    if (file_exists($oldPath)) unlink($oldPath);
                }
                
                $a->setImagePath('uploads/images/' . $folder . '/' . $filename);
            }

            $this->em->flush();

            return $this->json(['success' => true, 'message' => 'Accommodation updated successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Delete ──────────────────────────────────────────────────────
    #[Route('/{id}/delete', name: 'delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try {
            $a = $this->repo->find($id);
            if (!$a) return $this->json(['error' => 'Not found'], 404);

            // Delete image file if exists
            if ($a->getImagePath()) {
                $imagePath = $this->getParameter('kernel.project_dir') . '/public/' . $a->getImagePath();
                if (file_exists($imagePath)) unlink($imagePath);
            }

            $this->em->remove($a);
            $this->em->flush();

            return $this->json(['success' => true, 'message' => 'Accommodation deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Hydrate ─────────────────────────────────────────────────────
    private function hydrate(Accommodation $a, array $data): void
    {
        if (array_key_exists('name', $data))        $a->setName($data['name']);
        if (array_key_exists('type', $data))        $a->setType($data['type']);
        if (array_key_exists('city', $data))        $a->setCity($data['city']);
        if (array_key_exists('country', $data))     $a->setCountry($data['country']);
        if (array_key_exists('address', $data))     $a->setAddress($data['address']);
        if (array_key_exists('postalCode', $data))  $a->setPostalCode($data['postalCode']);
        if (array_key_exists('latitude', $data))    $a->setLatitude($data['latitude'] ?: null);
        if (array_key_exists('longitude', $data))   $a->setLongitude($data['longitude'] ?: null);
        if (array_key_exists('description', $data)) $a->setDescription($data['description']);
        if (array_key_exists('stars', $data))       $a->setStars((int)$data['stars']);
        if (array_key_exists('status', $data))      $a->setStatus($data['status']);
        if (array_key_exists('phone', $data))       $a->setPhone($data['phone']);
        if (array_key_exists('email', $data))       $a->setEmail($data['email']);
        if (array_key_exists('website', $data))     $a->setWebsite($data['website']);
        if (array_key_exists('amenities', $data))   $a->setAccommodationAmenities($data['amenities']);
    }
}