<?php
namespace App\service;

use App\Entity\Bookingtrans;
use App\Repository\BookingtransRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\service\BookingMailerService;
use App\service\TransportService;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\SvgWriter;

class BookingtransService
{
    private EntityManagerInterface $entityManager;
    private BookingtransRepository $repository;
    private BookingMailerService $mailerService;
    private TransportService $transportService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        BookingtransRepository $repository,
        BookingMailerService $mailerService,
        TransportService $transportService
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->mailerService = $mailerService;
        $this->transportService = $transportService;
    }

    // Create
    public function addBookingtrans(Bookingtrans $b): void
    {
        $this->entityManager->persist($b);
        $this->entityManager->flush();
        
        // Generate QR code after we have the ID
        $this->generateQrCode($b);
        $this->entityManager->flush();

        // Send PENDING email
        $transport = $this->transportService->findById($b->getTransportId());
        if ($transport) {
            $user = $this->entityManager->getRepository(\App\Entity\User::class)->find($b->getUserId());
            $userEmail = $user ? $user->getEmail() : 'test@tripx.com';
            $this->mailerService->sendBookingPending($b, $transport, $userEmail);
        }
    }

    public function generateQrCode(Bookingtrans $b): void
    {
        try {
            $writer = new SvgWriter();
            
            // Content: Booking ID + "TripX Reservation"
            $content = "TripX Reservation\nBooking ID: " . $b->getBookingId() . "\nUser ID: " . $b->getUserId();
            
            $qrCode = new QrCode(
                data: $content,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 300,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                foregroundColor: new Color(31, 41, 76),
                backgroundColor: new Color(255, 255, 255)
            );

            $result = $writer->write($qrCode);
            
            $fileName = 'booking_' . $b->getBookingId() . '_' . uniqid() . '.svg';
            // Using a relative path for the database, and absolute for saving
            // Note: In a real app, use kernel.project_dir parameter
            $uploadPath = 'uploads/qrcodes/' . $fileName;
            $absolutePath = __DIR__ . '/../../public/' . $uploadPath;
            
            $result->saveToFile($absolutePath);
            
            $b->setQrCode($uploadPath);
        } catch (\Throwable $e) {
            // Log error but continue without QR code
            // error_log('Failed to generate QR code: ' . $e->getMessage());
        }
    }

    // Read all
    public function getAllBookings(): array
    {
        return $this->repository->findAll();
    }

    // Update
    public function updateBookingtrans(Bookingtrans $b): void
    {
        $uow = $this->entityManager->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($b);

        $this->entityManager->flush();

        if (isset($changeset['bookingStatus'])) {
            $oldStatus = $changeset['bookingStatus'][0] ?? null;
            $newStatus = $changeset['bookingStatus'][1] ?? null;
            
            if ($oldStatus !== $newStatus) {
                $transport = $this->transportService->findById($b->getTransportId());
                if ($transport) {
                    $user = $this->entityManager->getRepository(\App\Entity\User::class)->find($b->getUserId());
                    $userEmail = $user ? $user->getEmail() : 'test@tripx.com';

                    if ($newStatus === 'CONFIRMED') {
                        $this->mailerService->sendBookingConfirmation($b, $transport, $userEmail);
                    } elseif ($newStatus === 'CANCELLED') {
                        $reason = $b->getCancellationReason();
                        if (empty($reason)) $reason = "TripX administrator cancelled the booking.";
                        $this->mailerService->sendBookingCancellation($b, $transport, $reason, $userEmail);
                    }
                }
            }
        }
    }

    // Delete
    public function deleteBookingtrans(int $id): void
    {
        $booking = $this->repository->find($id);
        if ($booking) {
            $this->entityManager->remove($booking);
            $this->entityManager->flush();
        }
    }

    // Get bookings by user ID
    public function getBookingsByUserId(int $userId): array
    {
        return $this->repository->findBy(['userId' => $userId]);
    }
    public function findById(int $id): ?Bookingtrans
{
    return $this->repository->find($id);
}
}