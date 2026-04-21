<?php

namespace App\Controller\user;

use App\Entity\PacksBooking;
use App\service\PackService;
use App\service\OfferService;
use App\service\BookingPacksService;
use App\service\LoyaltyService;
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
        private PackService    $packService,
        private OfferService   $offerService,
        private BookingPacksService $bookingPacksService,
        private LoyaltyService $loyaltyService,
        private EntityManagerInterface $em
    ) {}

    // ─── MERGED PACKS & OFFERS PAGE ───────────────────────────────────────────

    #[Route('/packs-offers', name: 'user_packs_offers')]
    public function packsAndOffers(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $userId = $user->getId();

        // Packs with their active offers
        $packs = $this->packService->getActivePacks();
        $packsWithOffers = [];
        foreach ($packs as $pack) {
            $packsWithOffers[] = [
                'pack'  => $pack,
                'offer' => $this->offerService->getActiveOfferForPack($pack->getIdPack()),
            ];
        }

        // Active offers
        $offers = $this->offerService->getActiveOffers();

        // Pack map for bookings display
        $packMap = [];
        foreach ($this->packService->getAll() as $p) {
            $packMap[$p->getIdPack()] = $p;
        }

        // Bookings
        $bookings = $this->bookingPacksService->getByUserId($userId);

        // Loyalty
        $loyalty = $this->loyaltyService->getOrCreate($userId);

        return $this->render('front/packs_and_offers.html.twig', [
            'packsWithOffers' => $packsWithOffers,
            'offers'          => $offers,
            'packs'           => $packMap,   // for offers section (pack name lookup)
            'packMap'         => $packMap,   // for bookings section
            'bookings'        => $bookings,
            'loyalty'         => $loyalty,
        ]);
    }


    #[Route('/packs-offers/search', name: 'user_packs_search', methods: ['GET'])]
public function searchPacks(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
{
    $query = $request->query->get('q', '');
    $packs = $this->packService->getActivePacks();

    if (!empty($query)) {
        $packs = array_filter($packs, fn($p) =>
            stripos($p->getTitle(), $query) !== false ||
            stripos($p->getDescription() ?? '', $query) !== false
        );
    }

    $result = [];
    foreach ($packs as $pack) {
        $offer = $this->offerService->getActiveOfferForPack($pack->getIdPack());
        $result[] = [
            'id'          => $pack->getIdPack(),
            'title'       => $pack->getTitle(),
            'description' => $pack->getDescription() ? mb_substr($pack->getDescription(), 0, 90) : '',
            'duration'    => $pack->getDurationDays(),
            'price'       => number_format((float)$pack->getBasePrice(), 0),
            'offer'       => $offer ? [
                'title'         => $offer->getTitle(),
                'discountType'  => $offer->getDiscountType(),
                'discountValue' => $offer->getDiscountValue(),
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
        $user = $this->getUser();
        $userId = $user->getId();
        
        $offer  = $this->offerService->getActiveOfferForPack($id);
        $lp     = $this->loyaltyService->getByUserId($userId);

        $offerDiscount   = 0;
        $loyaltyDiscount = $lp ? $lp->getLoyaltyDiscountPercent() : 0;

        if ($offer && $offer->getDiscountType() === 'PERCENTAGE') {
            $offerDiscount = (float) $offer->getDiscountValue();
        }

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
        ]);
    }

    // ─── CANCEL BOOKING ───────────────────────────────────────────────────────

    #[Route('/pack-bookings/cancel/{id}', name: 'user_pack_booking_cancel')]
    public function cancelBooking(int $id): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();
        $booking = $this->bookingPacksService->find($id);

        if ($booking && $booking->getUserId() === $userId && $booking->getStatus() === 'PENDING') {
            $this->bookingPacksService->updateStatus($id, 'CANCELLED');
            $this->addFlash('success', 'Booking cancelled.');
        } else {
            $this->addFlash('error', 'Cannot cancel this booking.');
        }

        return $this->redirectToRoute('user_packs_offers', ['section' => 'bookings']);
    }

    // ─── KEEP OLD ROUTES AS REDIRECTS (avoid 404 if linked elsewhere) ─────────

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
