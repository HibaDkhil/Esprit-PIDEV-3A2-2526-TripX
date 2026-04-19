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
            $userEmail = $this->resolveUserEmail($b);
            if ($userEmail) {
                $this->mailerService->sendBookingPending($b, $transport, $userEmail);
            }
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
                    $userEmail = $this->resolveUserEmail($b);
                    if (!$userEmail) return; // Cannot notify if no owner email

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

    /**
     * Notifies all users impacted by a schedule update (delay or cancellation).
     */
    public function notifyImpactedUsers(int $scheduleId, string $updateType, ?int $delayMinutes = null): void
    {
        $bookings = $this->repository->findBy(['scheduleId' => $scheduleId]);
        foreach ($bookings as $b) {
            // Only notify if the booking is not already cancelled
            if ($b->getBookingStatus() !== 'CANCELLED') {
                $transport = $this->transportService->findById($b->getTransportId());
                $userEmail = $this->resolveUserEmail($b);
                
                if ($transport && $userEmail) {
                    $this->mailerService->sendScheduleUpdateNotification($b, $transport, $updateType, $userEmail, $delayMinutes);
                }
            }
        }
    }

    /**
     * Resolves the email address for the owner of the booking.
     * Guaranteed to return a real user email or null (no hardcoded admin fallbacks).
     */
    private function resolveUserEmail(Bookingtrans $booking): ?string
    {
        $userId = $booking->getUserId();
        if (!$userId) return null;

        $user = $this->entityManager->getRepository(\App\Entity\User::class)->find($userId);
        return $user ? $user->getEmail() : null;
    }
}