<?php

namespace App\Controller\admin;

use App\service\AdminService;
use App\service\DestinationService;
use App\service\ActivityService;
use App\service\TransportService;
use App\service\BookingtransService;
use App\Entity\Destination;
use App\Entity\Activity;
use App\form\DestinationType;
use App\form\ActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Preference;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\RoomRepository;
use App\Repository\RoomImagesRepository;
use App\Entity\Room;

#[Route('/admin', name: 'admin_')]
#[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION') or is_granted('ROLE_ADMIN_ACCOMODATION') or is_granted('ROLE_ADMIN_OFFERS') or is_granted('ROLE_ADMIN_BLOG') or is_granted('ROLE_ADMIN_TRANSPORT')"))]
class AdminController extends AbstractController
{
    private AdminService $adminService;
    private $destinationService;
    private $activityService;
    private TransportService $transportService;
    private BookingtransService $bookingService;

    public function __construct(
        AdminService $adminService,
        DestinationService $destinationService,
        ActivityService $activityService,
        TransportService $transportService,
        BookingtransService $bookingService
    ) {
        $this->adminService = $adminService;
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
        $this->transportService = $transportService;
        $this->bookingService = $bookingService;
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('admin/admin_profile.html.twig');
    }

    #[Route('/profile/update', name: 'profile_update', methods: ['POST'])]
    public function updateProfile(Request $request, EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if ($user) {
            $firstName = trim((string) $request->request->get('firstName'));
            $lastName = trim((string) $request->request->get('lastName'));
            $email = trim((string) $request->request->get('email'));
            if ($firstName === '' || $lastName === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addFlash('error', 'Please fill valid profile fields.');
                return $this->redirectToRoute('admin_profile');
            }
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $em->flush();
            $this->addFlash('success', 'Profile updated successfully.');
        }
        return $this->redirectToRoute('admin_profile');
    }

    #[Route('/profile/password', name: 'profile_password', methods: ['POST'])]
    public function updatePassword(Request $request, EntityManagerInterface $em, \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $new = $request->request->get('new_password');
        $confirm = $request->request->get('confirm_password');
        if ($new !== $confirm) {
            $this->addFlash('error', 'Passwords do not match.');
            return $this->redirectToRoute('admin_profile');
        }
        $user->setPassword($passwordHasher->hashPassword($user, $new));
        $em->flush();
        $this->addFlash('success', 'Password updated successfully.');
        return $this->redirectToRoute('admin_profile');
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(): Response
    {
        $userStats = $this->adminService->getDashboardStats();

        $transports = $this->transportService->getAllTransports();
        $bookings   = $this->bookingService->getAllBookings();
        $confirmed = $pending = $cancelled = 0;
        $revenue = 0.0;
        foreach ($bookings as $b) {
            $status = strtoupper((string)$b->getBookingStatus());
            if ($status === 'CONFIRMED')  { $confirmed++; $revenue += $b->getTotalPrice(); }
            elseif ($status === 'PENDING')   { $pending++; }
            elseif ($status === 'CANCELLED') { $cancelled++; }
        }
        $total = count($bookings);
        $transportStats = [
            'vehicles'             => count($transports),
            'total'                => $total,
            'confirmed'            => $confirmed,
            'pending'              => $pending,
            'cancelled'            => $cancelled,
            'revenue'              => round($revenue, 2),
            'confirmationRate'     => $total > 0 ? round($confirmed * 100.0 / $total, 1) : 0,
            'cancellationRate'     => $total > 0 ? round($cancelled * 100.0 / $total, 1) : 0,
            'avgRevenuePerBooking' => $confirmed > 0 ? round($revenue / $confirmed, 2) : 0,
        ];

        return $this->render('admin/dashboard.html.twig', array_merge($userStats, [
            'stats' => $transportStats,
        ]));
    }

    #[Route('/rooms', name: 'rooms_all', methods: ['GET'])]
    public function allRooms(RoomRepository $roomRepo, RoomImagesRepository $imgRepo): Response
    {
        $rooms = $roomRepo->findAll();
        
        $roomsData = array_map(function(Room $r) use ($imgRepo) {
            $primaryImg = $imgRepo->findOneBy(['room' => $r, 'isPrimary' => true])
                       ?? $imgRepo->findOneBy(['room' => $r], ['displayOrder' => 'ASC']);
            $allImages  = $imgRepo->findBy(['room' => $r], ['displayOrder' => 'ASC']);
            return [
                'room'        => $r,
                'primaryImg'  => $primaryImg,
                'allImages'   => $allImages,
                'imageCount'  => count($allImages),
                'acc'         => $r->getAccommodation()
            ];
        }, $rooms);

        return $this->render('admin/rooms_all.html.twig', [
            'roomsData' => $roomsData,
            'total'     => count($rooms),
            'available' => count(array_filter($rooms, fn($r) => $r->isAvailable())),
        ]);
    }

    #[Route('/users', name: 'users')]
    #[IsGranted('ROLE_ADMIN')]
    public function users(Request $request, PaginatorInterface $paginator): Response 
    { 
        $query = $request->query->get('q', '');
        $sortBy = $request->query->get('s', 'userId');
        $order = $request->query->get('order', 'ASC');

        $allowedSort = ['userId', 'email', 'firstName', 'lastName', 'role', 'status', 'birthYear', 'gender'];
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'userId';
        }

        $usersQuery = $this->adminService->getAllUsers($query, $sortBy, $order);
        $stats = $this->adminService->getDashboardStats();
        
        $pagination = $paginator->paginate(
            $usersQuery,
            $request->query->getInt('page', 1),
            10
        );
        
        return $this->render('admin/users.html.twig', [
            'users' => $pagination,
            'stats' => $stats,
            'currentQuery' => $query,
            'currentSort' => $sortBy,
            'currentOrder' => $order
        ]); 
    }

    #[Route('/users/search', name: 'users_search', methods: ['GET'])]
    public function searchUsers(Request $request, UserRepository $repo): JsonResponse
    {
        $q = $request->query->get('q', '');
        $users = $repo->searchByDQL($q);
        
        $data = [];
        foreach ($users as $u) {
            $data[] = [
                'userId' => $u->getId(),
                'firstName' => $u->getFirstName(),
                'lastName' => $u->getLastName(),
                'email' => $u->getEmail(),
                'role' => $u->getRole(),
                'status' => $u->getStatus(),
                'gender' => $u->getGender(),
                'birthYear' => $u->getBirthYear(),
            ];
        }
        
        return new JsonResponse($data);
    }

    #[Route('/users/edit/{id}', name: 'user_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function editUser(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(\App\Entity\User::class)->find($id);
        if (!$user) {
            $this->addFlash('error', 'User not found.');
            return $this->redirectToRoute('admin_users');
        }

        if ($request->isMethod('POST')) {
            $firstName = trim((string) $request->request->get('firstName'));
            $lastName = trim((string) $request->request->get('lastName'));
            $email = trim((string) $request->request->get('email'));
            if ($firstName === '' || $lastName === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addFlash('error', 'Invalid user fields. Please check and try again.');
                return $this->redirectToRoute('admin_user_edit', ['id' => $id]);
            }
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setRole($request->request->get('role', 'user'));
            $user->setUpdatedAt(new \DateTime());
            
            $em->flush();
            $this->addFlash('success', 'User updated successfully.');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user_edit.html.twig', [
            'target_user' => $user
        ]);
    }

    #[Route('/users/ban/{id}', name: 'user_ban')]
    #[IsGranted('ROLE_ADMIN')]
    public function banUser(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(\App\Entity\User::class)->find($id);
        if ($user) {
            $user->setStatus('banned');
            $em->flush();
            $this->addFlash('success', 'User has been banned.');
        }
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/users/delete/{id}', name: 'user_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(int $id): Response
    {
        try {
            if ($this->adminService->deleteUser($id)) {
                $this->addFlash('success', 'User removed successfully.');
            } else {
                $this->addFlash('error', 'User not found.');
            }
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error: ' . $e->getMessage());
        }
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/users/unban/{id}', name: 'user_unban')]
    #[IsGranted('ROLE_ADMIN')]
    public function unbanUser(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(\App\Entity\User::class)->find($id);
        if ($user) {
            $user->setStatus('active');
            $em->flush();
            $this->addFlash('success', 'User has been unbanned.');
        }
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/destinations', name: 'destinations')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function destinations(Request $request): Response 
    { 
        $query = $request->query->get('q', '');
        $items = $this->destinationService->getAll($query);
        
        $totalDestinations = count($items);
        $avgRating = 0;
        if ($totalDestinations > 0) {
            $sum = 0;
            foreach ($items as $item) {
                $sum += (float) $item->getAverageRating();
            }
            $avgRating = $sum / $totalDestinations;
        }

        return $this->render('admin/destinations.html.twig', [
            'items' => $items,
            'currentQuery' => $query,
            'stats' => [
                'total' => $totalDestinations,
                'avg_rating' => round($avgRating, 1)
            ]
        ]); 
    }

    #[Route('/destinations/api/sort', name: 'destinations_api_sort', methods: ['GET'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function sortDestinations(Request $request, \App\Repository\DestinationRepository $repo): JsonResponse
    {
        $sort = $request->query->get('sort', 'destinationId');
        $order = $request->query->get('order', 'ASC');
        
        $allowedSorts = ['destinationId', 'name', 'country', 'type', 'estimatedBudget'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'destinationId';
        }
        
        $qb = $repo->createQueryBuilder('d')->orderBy('d.' . $sort, $order);
                   
        $q = $request->query->get('q');
        if (!empty($q)) {
            $qb->where('d.name LIKE :q OR d.country LIKE :q OR d.type LIKE :q')
               ->setParameter('q', '%' . $q . '%');
        }
        
        $destinations = $qb->getQuery()->getResult();
        
        $data = [];
        foreach ($destinations as $d) {
            $data[] = [
                'id' => $d->getDestinationId(),
                'name' => $d->getName(),
                'country' => $d->getCountry(),
                'type' => $d->getType(),
                'estimatedBudget' => $d->getEstimatedBudget(),
                'imageUrl' => $d->getImageUrl(),
                'url_edit' => $this->generateUrl('admin_destination_edit', ['id' => $d->getDestinationId()]),
                'url_delete' => $this->generateUrl('admin_destination_delete', ['id' => $d->getDestinationId()]),
            ];
        }
        
        return new JsonResponse($data);
    }

    #[Route('/users/detail/{id}', name: 'user_detail')]
    public function userDetail(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->find($id);
        $preferences = $em->getRepository(Preference::class)->findOneBy(['userId' => $id]);
        
        return $this->render('admin/user_detail.html.twig', [
            'user' => $user,
            'preferences' => $preferences
        ]);
    }

    #[Route('/destinations/add', name: 'destination_add', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function addDestination(Request $request): Response
    {
        $dest = new Destination();
        $form = $this->createForm(DestinationType::class, $dest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->destinationService->save($dest);
            $this->addFlash('success', 'Destination added.');
            return $this->redirectToRoute('admin_destinations');
        }

        return $this->render('admin/destination_form.html.twig', [
            'target_destination' => null,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/destinations/edit/{id}', name: 'destination_edit', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function editDestination(int $id, Request $request): Response
    {
        $dest = $this->destinationService->find($id);
        if (!$dest) return $this->redirectToRoute('admin_destinations');

        $form = $this->createForm(DestinationType::class, $dest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->destinationService->save($dest);
            $this->addFlash('success', 'Destination updated.');
            return $this->redirectToRoute('admin_destinations');
        }

        return $this->render('admin/destination_form.html.twig', [
            'target_destination' => $dest,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/destinations/delete/{id}', name: 'destination_delete')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function deleteDestination(int $id): Response
    {
        if ($this->destinationService->delete($id)) {
            $this->addFlash('success', 'Destination removed.');
        }
        return $this->redirectToRoute('admin_destinations');
    }

    #[Route('/activities', name: 'activities')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function activities(Request $request): Response 
    { 
        $query = $request->query->get('q', '');
        $items = $this->activityService->getAll($query);
        
        $totalActivities = count($items);
        $avgPrice = 0;
        if ($totalActivities > 0) {
            $sum = 0;
            foreach ($items as $item) {
                $sum += (float) $item->getPrice();
            }
            $avgPrice = $sum / $totalActivities;
        }

        return $this->render('admin/activities.html.twig', [
            'items' => $items,
            'currentQuery' => $query,
            'stats' => [
                'total' => $totalActivities,
                'avg_price' => round($avgPrice, 2)
            ]
        ]); 
    }

    #[Route('/activities/api/sort', name: 'activities_api_sort', methods: ['GET'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function sortActivities(Request $request, \App\Repository\ActivityRepository $repo): JsonResponse
    {
        $sort = $request->query->get('sort', 'activityId');
        $order = $request->query->get('order', 'ASC');
        
        $allowedSorts = ['activityId', 'name', 'category', 'price', 'durationMinutes'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'activityId';
        }
        
        $qb = $repo->createQueryBuilder('a')->orderBy('a.' . $sort, $order);
                   
        $q = $request->query->get('q');
        if (!empty($q)) {
            $qb->where('a.name LIKE :q OR a.category LIKE :q')
               ->setParameter('q', '%' . $q . '%');
        }
        
        $activities = $qb->getQuery()->getResult();
        
        $data = [];
        foreach ($activities as $a) {
            $data[] = [
                'id' => $a->getActivityId(),
                'name' => $a->getName(),
                'category' => $a->getCategory(),
                'price' => $a->getPrice(),
                'duration' => $a->getDurationMinutes(),
                'url_edit' => $this->generateUrl('admin_activity_edit', ['id' => $a->getActivityId()]),
                'url_delete' => $this->generateUrl('admin_activity_delete', ['id' => $a->getActivityId()]),
            ];
        }
        
        return new JsonResponse($data);
    }

    #[Route('/activities/add', name: 'activity_add', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function addActivity(Request $request): Response
    {
        $act = new Activity();
        $form = $this->createForm(ActivityType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->activityService->save($act);
            $this->addFlash('success', 'Activity added.');
            return $this->redirectToRoute('admin_activities');
        }

        return $this->render('admin/activity_form.html.twig', [
            'target_activity' => null,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/activities/edit/{id}', name: 'activity_edit', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function editActivity(int $id, Request $request): Response
    {
        $act = $this->activityService->find($id);
        if (!$act) return $this->redirectToRoute('admin_activities');

        $form = $this->createForm(ActivityType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->activityService->save($act);
            $this->addFlash('success', 'Activity updated.');
            return $this->redirectToRoute('admin_activities');
        }

        return $this->render('admin/activity_form.html.twig', [
            'target_activity' => $act,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/activities/delete/{id}', name: 'activity_delete')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function deleteActivity(int $id): Response
    {
        if ($this->activityService->delete($id)) {
            $this->addFlash('success', 'Activity removed.');
        }
        return $this->redirectToRoute('admin_activities');
    }

    #[Route('/accommodations', name: 'accommodations')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_ACCOMODATION')"))]
    public function accommodations(): Response { return $this->render('admin/accommodations.html.twig'); }

    #[Route('/offers', name: 'offers')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_OFFERS')"))]
    public function offers(): Response { return $this->render('admin/offers.html.twig'); }

    
}