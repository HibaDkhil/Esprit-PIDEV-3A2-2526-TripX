<?php

namespace App\Controller\user;

use App\Entity\PacksBooking;
use App\service\PackService;
use App\service\OfferService;
use App\service\BookingPacksService;
use App\service\LoyaltyService;
use App\service\DestinationService;
use App\service\RestCountriesService;
use App\service\PackRecommendationService;
use App\service\PackBookingDetailsPdfService;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class FrontPacksController extends AbstractController
{
    public function __construct(
        private PackService                 $packService,
        private OfferService                $offerService,
        private BookingPacksService         $bookingPacksService,
        private LoyaltyService              $loyaltyService,
        private DestinationService          $destinationService,
        private RestCountriesService        $restCountriesService,
        private PackRecommendationService   $recommendationService,
        private PackBookingDetailsPdfService $bookingDetailsPdfService,
        private EntityManagerInterface      $em
    ) {}

    // ─── MERGED PACKS & OFFERS PAGE ───────────────────────────────────────────

    #[Route('/packs-offers', name: 'user_packs_offers')]
    public function packsAndOffers(): Response
    {
        /** @var \App\Entity\User $user */
        $user   = $this->getUser();
        $userId = $user->getId();

        // ── Active packs ──────────────────────────────────────────────────────
        $packs = $this->packService->getActivePacks();

        // ── Resolve destinations + batch-fetch unique country info ────────────
        $countryInfoByName = [];
        $destinationsById  = [];
        $countries         = [];

        foreach ($packs as $pack) {
            $destId = $pack->getDestinationId();
            if (!$destId) continue;
            $dest = $this->destinationService->find($destId);
            if ($dest) {
                $destinationsById[$destId] = $dest;
                if ($dest->getCountry()) {
                    $countries[$dest->getCountry()] = true;
                }
            }
        }

        foreach (array_keys($countries) as $countryName) {
            $info = $this->restCountriesService->getCountryByName($countryName);
            if ($info) {
                $countryInfoByName[$countryName] = $info;
            }
        }

        // ── Build packsWithOffers array ───────────────────────────────────────
        $packsWithOffers = [];
        foreach ($packs as $pack) {
            $dest   = null;
            $destId = $pack->getDestinationId();
            if ($destId && isset($destinationsById[$destId])) {
                $dest = $destinationsById[$destId];
            }
            $packsWithOffers[] = [
                'pack'        => $pack,
                'offer'       => $this->offerService->getActiveOfferForPack($pack->getIdPack()),
                'destination' => $dest,
            ];
        }

        // ── Recommendation engine ─────────────────────────────────────────────
        $scoredPacks        = $this->recommendationService->getScoredPacks($userId, $packs);
        $topRecommendations = array_slice($scoredPacks, 0, 6);

        // Build scoreMap: packId => [score, label, color, reasons]
        $scoreMap = [];
        foreach ($scoredPacks as $row) {
            $scoreMap[$row['pack']->getIdPack()] = [
                'score'   => $row['score'],
                'label'   => $row['label'],
                'color'   => $row['color'],
                'reasons' => $row['reasons'],
            ];
        }

        // ── Offers, bookings, loyalty ─────────────────────────────────────────
        $offers   = $this->offerService->getActiveOffers();
        $packMap  = [];
        foreach ($this->packService->getAll() as $p) {
            $packMap[$p->getIdPack()] = $p;
        }
        $bookings = $this->bookingPacksService->getByUserId($userId);
        $loyalty  = $this->loyaltyService->getOrCreate($userId);

        return $this->render('front/packs_and_offers.html.twig', [
            'packsWithOffers'    => $packsWithOffers,
            'offers'             => $offers,
            'packs'              => $packMap,
            'packMap'            => $packMap,
            'bookings'           => $bookings,
            'loyalty'            => $loyalty,
            'countryInfoByName'  => $countryInfoByName,
            'topRecommendations' => $topRecommendations,
            'scoreMap'           => $scoreMap,
        ]);
    }

    // ─── PACK SEARCH (AJAX) ───────────────────────────────────────────────────

    #[Route('/packs-offers/search', name: 'user_packs_search', methods: ['GET'])]
    public function searchPacks(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user   = $this->getUser();
        $userId = $user->getId();
        $query  = $request->query->get('q', '');
        $packs  = $this->packService->getActivePacks();

        if (!empty($query)) {
            $packs = array_filter($packs, fn($p) =>
                stripos($p->getTitle(), $query) !== false ||
                stripos($p->getDescription() ?? '', $query) !== false
            );
        }

        // Score the filtered packs so search results also show match scores
        $scored   = $this->recommendationService->getScoredPacks($userId, array_values($packs));
        $scoreMap = [];
        foreach ($scored as $row) {
            $scoreMap[$row['pack']->getIdPack()] = $row;
        }

        $result = [];
        foreach ($packs as $pack) {
            $offer     = $this->offerService->getActiveOfferForPack($pack->getIdPack());
            $scoreData = $scoreMap[$pack->getIdPack()] ?? null;
            $result[]  = [
                'id'          => $pack->getIdPack(),
                'title'       => $pack->getTitle(),
                'description' => $pack->getDescription() ? mb_substr($pack->getDescription(), 0, 90) : '',
                'duration'    => $pack->getDurationDays(),
                'price'       => number_format((float) $pack->getBasePrice(), 0),
                'offer'       => $offer ? [
                    'title'         => $offer->getTitle(),
                    'discountType'  => $offer->getDiscountType(),
                    'discountValue' => $offer->getDiscountValue(),
                ] : null,
                'score' => $scoreData ? [
                    'value'   => $scoreData['score'],
                    'label'   => $scoreData['label'],
                    'color'   => $scoreData['color'],
                ] : null,
            ];
        }

        return $this->json($result);
    }

    // ─── PACK DETAILS + BOOKING ───────────────────────────────────────────────

    #[Route('/packs/{id}', name: 'user_pack_details')]
    public function packDetails(int $id, Request $request): Response
    {
        $pack = $this->packService->find($id);
        if (!$pack || $pack->getStatus() !== 'ACTIVE') {
            $this->addFlash('error', 'Pack not found.');
            return $this->redirectToRoute('user_packs_offers');
        }

        /** @var \App\Entity\User $user */
        $user   = $this->getUser();
        $userId = $user->getId();

        $offer  = $this->offerService->getActiveOfferForPack($id);
        $lp     = $this->loyaltyService->getByUserId($userId);

        $offerDiscount   = 0;
        $loyaltyDiscount = $lp ? $lp->getLoyaltyDiscountPercent() : 0;

        if ($offer && $offer->getDiscountType() === 'PERCENTAGE') {
            $offerDiscount = (float) $offer->getDiscountValue();
        }

        // ── Country info for this pack's destination ──────────────────────────
        $countryInfo = null;
        $destination = null;
        if ($pack->getDestinationId()) {
            $destination = $this->destinationService->find($pack->getDestinationId());
            if ($destination && $destination->getCountry()) {
                $countryInfo = $this->restCountriesService->getCountryByName($destination->getCountry());
            }
        }

        // ── Recommendation score for this specific pack ───────────────────────
        $scoreData = $this->recommendationService->scoreOne($userId, $pack);

        // ── Handle booking POST ───────────────────────────────────────────────
        if ($request->isMethod('POST')) {
            $startDate    = new \DateTime($request->request->get('travelStartDate'));
            $endDate      = new \DateTime($request->request->get('travelEndDate'));
            $numTravelers = (int) $request->request->get('numTravelers', 1);
            $notes        = $request->request->get('notes', '');

            $baseTotal   = (float) $pack->getBasePrice() * $numTravelers;
            $finalPrice  = $this->loyaltyService->calculateFinalPrice($baseTotal, $userId, $offerDiscount);
            $discountAmt = $baseTotal - $finalPrice;

            $booking = new PacksBooking();
            $booking->setUserId($userId);
            $booking->setPackId($id);
            $booking->setTravelStartDate($startDate);
            $booking->setTravelEndDate($endDate);
            $booking->setNumTravelers($numTravelers);
            $booking->setTotalPrice((string) $baseTotal);
            $booking->setDiscountApplied((string) $discountAmt);
            $booking->setFinalPrice((string) $finalPrice);
            $booking->setNotes($notes);
            $booking->setStatus('PENDING');

            $this->bookingPacksService->save($booking);
            $this->loyaltyService->addTripPoints($userId);

            $this->addFlash('success', 'Booking submitted! You earned 50 loyalty points.');
            return $this->redirectToRoute('user_packs_offers', ['section' => 'bookings']);
        }

        return $this->render('front/pack_details.html.twig', [
            'pack'            => $pack,
            'offer'           => $offer,
            'loyalty'         => $lp,
            'offerDiscount'   => $offerDiscount,
            'loyaltyDiscount' => $loyaltyDiscount,
            'countryInfo'     => $countryInfo,
            'destination'     => $destination,
            'scoreData'       => $scoreData,
        ]);
    }

    // ─── BOOKING DETAILS PAGE ─────────────────────────────────────────────────

    #[Route('/my-bookings/{id}', name: 'user_booking_details')]
    public function bookingDetails(int $id): Response
    {
        /** @var \App\Entity\User $user */
        $user    = $this->getUser();
        $booking = $this->bookingPacksService->find($id);

        // Security: only the owner can view
        if (!$booking || $booking->getUserId() !== $user->getId()) {
            $this->addFlash('error', 'Booking not found.');
            return $this->redirectToRoute('user_packs_offers', ['section' => 'bookings']);
        }

        $pack = $this->packService->find($booking->getPackId());

        // Duration in days
        $durationDays = 0;
        if ($booking->getTravelStartDate() && $booking->getTravelEndDate()) {
            $durationDays = $booking->getTravelStartDate()
                ->diff($booking->getTravelEndDate())->days;
        }

        // Generate QR code pointing to the PDF download URL
        $pdfUrl = $this->generateUrl(
            'user_booking_pdf',
            ['id' => $id],
            \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL
        );

        $qrCode = new QrCode($pdfUrl);
        $writer  = new PngWriter();
        $result  = $writer->write($qrCode);
        $qrDataUri = 'data:image/png;base64,' . base64_encode($result->getString());

        return $this->render('front/pack_booking_details.html.twig', [
            'booking'       => $booking,
            'pack'          => $pack,
            'durationDays'  => $durationDays,
            'qrCodeDataUri' => $qrDataUri,
        ]);
    }

    // ─── BOOKING PDF DOWNLOAD ─────────────────────────────────────────────────

    #[Route('/my-bookings/{id}/pdf', name: 'user_booking_pdf')]
    public function bookingPdf(int $id): Response
    {
        /** @var \App\Entity\User $user */
        $user    = $this->getUser();
        $booking = $this->bookingPacksService->find($id);

        // Security: owner only
        if (!$booking || $booking->getUserId() !== $user->getId()) {
            throw $this->createNotFoundException('Booking not found.');
        }
/*
        $userName = method_exists($user, 'getFullName')
            ? $user->getFullName()
            : ($user->getFirstName() . ' ' . $user->getLastName());
*/
        $userName = trim($user->getFirstName() . ' ' . $user->getLastName());

        $pdf      = $this->bookingDetailsPdfService->generate($booking, trim($userName));
        $filename = 'TripX-Booking-TRX-' . $id . '.pdf';

        return new Response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    // ─── CANCEL BOOKING ───────────────────────────────────────────────────────

    #[Route('/pack-bookings/cancel/{id}', name: 'user_pack_booking_cancel')]
    public function cancelBooking(int $id): Response
    {
        /** @var \App\Entity\User $user */
        $user    = $this->getUser();
        $userId  = $user->getId();
        $booking = $this->bookingPacksService->find($id);

        if ($booking && $booking->getUserId() === $userId && $booking->getStatus() === 'PENDING') {
            $this->bookingPacksService->updateStatus($id, 'CANCELLED');
            $this->addFlash('success', 'Booking cancelled.');
        } else {
            $this->addFlash('error', 'Cannot cancel this booking.');
        }

        return $this->redirectToRoute('user_packs_offers', ['section' => 'bookings']);
    }

    // ─── REDIRECT ALIASES ─────────────────────────────────────────────────────

    #[Route('/packs', name: 'user_packs')]
    public function packsRedirect(): Response
    {
        return $this->redirectToRoute('user_packs_offers', ['section' => 'packs']);
    }

    #[Route('/offers', name: 'user_offers')]
    public function offersRedirect(): Response
    {
        return $this->redirectToRoute('user_packs_offers', ['section' => 'offers']);
    }

    #[Route('/pack-bookings', name: 'user_pack_bookings')]
    public function bookingsRedirect(): Response
    {
        return $this->redirectToRoute('user_packs_offers', ['section' => 'bookings']);
    }

    #[Route('/my-loyalty', name: 'user_loyalty')]
    public function loyaltyRedirect(): Response
    {
        return $this->redirectToRoute('user_packs_offers', ['section' => 'loyalty']);
    }
}
