<?php

namespace App\Controller\admin;

use App\Entity\Pack;
use App\Entity\PackCategory;
use App\Entity\Offer;
use App\service\PackService;
use App\service\OfferService;
use App\service\BookingPacksService;
use App\service\LoyaltyService;
use App\service\DestinationService;
use App\Repository\AccommodationRepository;
use App\service\TransportService;
use App\service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;

#[Route('/admin', name: 'admin_')]
#[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_OFFERS')"))]
class AdminPacksController extends AbstractController
{
    public function __construct(
        private PackService             $packService,
        private OfferService            $offerService,
        private BookingPacksService     $bookingPacksService,
        private LoyaltyService          $loyaltyService,
        private DestinationService      $destinationService,
        private AccommodationRepository $accommodationRepo,
        private TransportService        $transportService,
        private ActivityService         $activityService,
        private EntityManagerInterface  $em
    ) {}

    // ─── PACKS ────────────────────────────────────────────────────────────────

    #[Route('/packs', name: 'packs')]
    public function packs(Request $request): Response
    {
        $query = $request->query->get('q', '');
        $items = $this->packService->getAll($query);
        $categories = $this->em->getRepository(PackCategory::class)->findAll();

        return $this->render('admin/packs.html.twig', [
            'items'        => $items,
            'categories'   => $categories,
            'currentQuery' => $query,
            'stats'        => $this->packService->getStats(),
        ]);
    }

    #[Route('/packs/add', name: 'pack_add', methods: ['GET', 'POST'])]
    public function addPack(Request $request): Response
    {
        $dropdowns = $this->getDropdowns();

        if ($request->isMethod('POST')) {
            $pack = new Pack();
            $this->hydratePack($pack, $request);
            $this->packService->save($pack);
            $this->addFlash('success', 'Pack added successfully.');
            return $this->redirectToRoute('admin_packs');
        }

        return $this->render('admin/pack_form.html.twig', array_merge(
            ['target_pack' => null],
            $dropdowns
        ));
    }

    #[Route('/packs/edit/{id}', name: 'pack_edit', methods: ['GET', 'POST'])]
    public function editPack(int $id, Request $request): Response
    {
        $pack = $this->packService->find($id);
        if (!$pack) {
            $this->addFlash('error', 'Pack not found.');
            return $this->redirectToRoute('admin_packs');
        }

        $dropdowns = $this->getDropdowns();

        if ($request->isMethod('POST')) {
            $this->hydratePack($pack, $request);
            $this->packService->save($pack);
            $this->addFlash('success', 'Pack updated successfully.');
            return $this->redirectToRoute('admin_packs');
        }

        return $this->render('admin/pack_form.html.twig', array_merge(
            ['target_pack' => $pack],
            $dropdowns
        ));
    }

    #[Route('/packs/delete/{id}', name: 'pack_delete')]
    public function deletePack(int $id): Response
    {
        if ($this->packService->delete($id)) {
            $this->addFlash('success', 'Pack removed.');
        }
        return $this->redirectToRoute('admin_packs');
    }

    #[Route('/packs/toggle/{id}', name: 'pack_toggle')]
    public function togglePack(int $id): Response
    {
        $pack = $this->packService->find($id);
        if ($pack) {
            $pack->setStatus($pack->getStatus() === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE');
            $this->packService->save($pack);
            $this->addFlash('success', 'Pack status updated.');
        }
        return $this->redirectToRoute('admin_packs');
    }

    private function hydratePack(Pack $pack, Request $req): void
    {
        $pack->setTitle($req->request->get('title'));
        $pack->setDescription($req->request->get('description'));
        $pack->setDurationDays((int) $req->request->get('durationDays'));
        $pack->setBasePrice($req->request->get('basePrice'));
        $pack->setStatus($req->request->get('status', 'ACTIVE'));
        $catId = $req->request->get('categoryId');
        if ($catId) $pack->setCategoryId((int) $catId);
        $destId = $req->request->get('destinationId');
        if ($destId) $pack->setDestinationId($destId);
        $actId = $req->request->get('activityId');
        if ($actId) $pack->setActivityId($actId);
        $accId = $req->request->get('accommodationId');
        if ($accId) $pack->setAccommodationId((int) $accId);
        $transId = $req->request->get('transportId');
        if ($transId) $pack->setTransportId((int) $transId);
    }

    private function getDropdowns(): array
    {
        return [
            'categories'     => $this->em->getRepository(PackCategory::class)->findAll(),
            'destinations'   => $this->destinationService->getAll(),
            'accommodations' => $this->accommodationRepo->findAll(),
            'transports'     => $this->transportService->getAll(),
            'activities'     => $this->activityService->getAll(),
        ];
    }

    // ─── CATEGORIES ───────────────────────────────────────────────────────────

    #[Route('/pack-categories', name: 'pack_categories')]
    public function categories(): Response
    {
        $items = $this->em->getRepository(PackCategory::class)->findAll();
        return $this->render('admin/categories.html.twig', [
            'items' => $items,
            'stats' => ['total' => count($items)],
        ]);
    }

    #[Route('/pack-categories/add', name: 'pack_category_add', methods: ['POST'])]
    public function addCategory(Request $request): Response
    {
        $cat = new PackCategory();
        $cat->setName($request->request->get('name'));
        $this->em->persist($cat);
        $this->em->flush();
        $this->addFlash('success', 'Category added.');
        return $this->redirectToRoute('admin_pack_categories');
    }

    #[Route('/pack-categories/edit/{id}', name: 'pack_category_edit', methods: ['POST'])]
    public function editCategory(int $id, Request $request): Response
    {
        $cat = $this->em->getRepository(PackCategory::class)->find($id);
        if ($cat) {
            $cat->setName($request->request->get('name'));
            $this->em->flush();
            $this->addFlash('success', 'Category updated.');
        }
        return $this->redirectToRoute('admin_pack_categories');
    }

    #[Route('/pack-categories/delete/{id}', name: 'pack_category_delete')]
    public function deleteCategory(int $id): Response
    {
        $cat = $this->em->getRepository(PackCategory::class)->find($id);
        if ($cat) {
            $this->em->remove($cat);
            $this->em->flush();
            $this->addFlash('success', 'Category removed.');
        }
        return $this->redirectToRoute('admin_pack_categories');
    }

    // ─── OFFERS ───────────────────────────────────────────────────────────────

    #[Route('/offers', name: 'offers')]
    public function offers(Request $request): Response
    {
        $query = $request->query->get('q', '');
        $items = $this->offerService->getAll($query);

        return $this->render('admin/offers.html.twig', [
            'items'        => $items,
            'currentQuery' => $query,
            'stats'        => $this->offerService->getStats(),
        ]);
    }

    #[Route('/offers/add', name: 'offer_add', methods: ['GET', 'POST'])]
    public function addOffer(Request $request): Response
    {
        $packs = $this->packService->getAll();

        if ($request->isMethod('POST')) {
            $offer = new Offer();
            $this->hydrateOffer($offer, $request);
            $this->offerService->save($offer);
            $this->addFlash('success', 'Offer added successfully.');
            return $this->redirectToRoute('admin_offers');
        }

        return $this->render('admin/offer_form.html.twig', [
            'target_offer' => null,
            'packs'        => $packs,
        ]);
    }

    #[Route('/offers/edit/{id}', name: 'offer_edit', methods: ['GET', 'POST'])]
    public function editOffer(int $id, Request $request): Response
    {
        $offer = $this->offerService->find($id);
        if (!$offer) {
            $this->addFlash('error', 'Offer not found.');
            return $this->redirectToRoute('admin_offers');
        }

        $packs = $this->packService->getAll();

        if ($request->isMethod('POST')) {
            $this->hydrateOffer($offer, $request);
            $this->offerService->save($offer);
            $this->addFlash('success', 'Offer updated successfully.');
            return $this->redirectToRoute('admin_offers');
        }

        return $this->render('admin/offer_form.html.twig', [
            'target_offer' => $offer,
            'packs'        => $packs,
        ]);
    }

    #[Route('/offers/delete/{id}', name: 'offer_delete')]
    public function deleteOffer(int $id): Response
    {
        if ($this->offerService->delete($id)) {
            $this->addFlash('success', 'Offer removed.');
        }
        return $this->redirectToRoute('admin_offers');
    }

    #[Route('/offers/toggle/{id}', name: 'offer_toggle')]
    public function toggleOffer(int $id): Response
    {
        $offer = $this->offerService->find($id);
        if ($offer) {
            $offer->setIsActive(!$offer->isActive());
            $this->offerService->save($offer);
            $this->addFlash('success', 'Offer status updated.');
        }
        return $this->redirectToRoute('admin_offers');
    }

    private function hydrateOffer(Offer $offer, Request $req): void
    {
        $offer->setTitle($req->request->get('title'));
        $offer->setDescription($req->request->get('description'));
        $offer->setDiscountType($req->request->get('discountType'));
        $offer->setDiscountValue($req->request->get('discountValue'));
        $offer->setIsActive($req->request->get('isActive') === '1');
        $packId = $req->request->get('packId');
        $offer->setPackId($packId ? (int) $packId : null);
        $offer->setStartDate(new \DateTime($req->request->get('startDate')));
        $offer->setEndDate(new \DateTime($req->request->get('endDate')));
    }

    // ─── BOOKINGS ─────────────────────────────────────────────────────────────

    #[Route('/bookings', name: 'pack_bookings')]
    public function bookings(): Response
    {
        $items = $this->bookingPacksService->getAll();
        $packs = [];
        foreach ($this->packService->getAll() as $p) {
            $packs[$p->getIdPack()] = $p;
        }

        return $this->render('admin/bookingspacks.html.twig', [
            'items' => $items,
            'packs' => $packs,
            'stats' => $this->bookingPacksService->getStats(),
        ]);
    }

    #[Route('/bookings/status/{id}/{status}', name: 'booking_status')]
    public function updateBookingStatus(int $id, string $status): Response
    {
        $allowed = ['PENDING', 'CONFIRMED', 'CANCELLED', 'COMPLETED'];
        if (in_array(strtoupper($status), $allowed)) {
            $this->bookingPacksService->updateStatus($id, strtoupper($status));
            $this->addFlash('success', 'Booking status updated.');
        }
        return $this->redirectToRoute('admin_pack_bookings');
    }

    #[Route('/bookings/delete/{id}', name: 'booking_delete')]
    public function deleteBooking(int $id): Response
    {
        if ($this->bookingPacksService->delete($id)) {
            $this->addFlash('success', 'Booking removed.');
        }
        return $this->redirectToRoute('admin_pack_bookings');
    }

    // ─── LOYALTY ──────────────────────────────────────────────────────────────

    #[Route('/loyalty', name: 'loyalty')]
    public function loyalty(): Response
    {
        $items = $this->loyaltyService->getAll();
        return $this->render('admin/loyalty.html.twig', [
            'items' => $items,
            'stats' => [
                'total'  => count($items),
                'gold'   => count(array_filter($items, fn($l) => $l->computeLevel() === 'GOLD')),
                'silver' => count(array_filter($items, fn($l) => $l->computeLevel() === 'SILVER')),
                'bronze' => count(array_filter($items, fn($l) => $l->computeLevel() === 'BRONZE')),
            ],
        ]);
    }
}
