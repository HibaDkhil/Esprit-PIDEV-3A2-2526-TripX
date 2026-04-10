<?php

namespace App\Controller\admin;

use App\service\AdminService;
use App\service\DestinationService;
use App\service\ActivityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin', name: 'admin_')]
#[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION') or is_granted('ROLE_ADMIN_ACCOMODATION') or is_granted('ROLE_ADMIN_OFFERS') or is_granted('ROLE_ADMIN_BLOG') or is_granted('ROLE_ADMIN_TRANSPORT')"))]
class AdminController extends AbstractController
{
    private $destinationService;
    private $activityService;

    public function __construct(AdminService $adminService, DestinationService $destinationService, ActivityService $activityService)
    {
        $this->adminService = $adminService;
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
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
            $user->setFirstName($request->request->get('firstName'));
            $user->setLastName($request->request->get('lastName'));
            $user->setEmail($request->request->get('email'));
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
        $stats = $this->adminService->getDashboardStats();
        return $this->render('admin/dashboard.html.twig', $stats);
    }

    #[Route('/users', name: 'users')]
    #[IsGranted('ROLE_ADMIN')]
    public function users(Request $request): Response 
    { 
        $query = $request->query->get('q', '');
        $sortBy = $request->query->get('sort', 'userId');
        $order = $request->query->get('order', 'ASC');

        // Whitelist sort fields
        $allowedSort = ['userId', 'email', 'firstName', 'lastName', 'status'];
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'userId';
        }

        $users = $this->adminService->getAllUsers($query, $sortBy, $order);
        $stats = $this->adminService->getDashboardStats();
        
        return $this->render('admin/users.html.twig', [
            'users' => $users,
            'stats' => $stats,
            'currentQuery' => $query,
            'currentSort' => $sortBy,
            'currentOrder' => $order
        ]); 
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
            $user->setFirstName($request->request->get('firstName'));
            $user->setLastName($request->request->get('lastName'));
            $user->setEmail($request->request->get('email'));
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
        if ($this->adminService->deleteUser($id)) {
            $this->addFlash('success', 'User removed successfully.');
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

    #[Route('/destinations/add', name: 'destination_add', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function addDestination(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $dest = new \App\Entity\Destination();
            $dest->setName($request->request->get('name'));
            $dest->setCountry($request->request->get('country'));
            $dest->setCity($request->request->get('city'));
            $dest->setType($request->request->get('type'));
            $dest->setBestSeason($request->request->get('bestSeason'));
            $dest->setEstimatedBudget($request->request->get('estimatedBudget'));
            $dest->setImageUrl($request->request->get('imageUrl'));
            $dest->setDescription($request->request->get('description'));
            $dest->setLatitude($request->request->get('latitude'));
            $dest->setLongitude($request->request->get('longitude'));
            
            $this->destinationService->save($dest);
            $this->addFlash('success', 'Destination added.');
            return $this->redirectToRoute('admin_destinations');
        }
        return $this->render('admin/destination_form.html.twig', ['target_destination' => null]);
    }

    #[Route('/destinations/edit/{id}', name: 'destination_edit', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function editDestination(int $id, Request $request): Response
    {
        $dest = $this->destinationService->find($id);
        if (!$dest) return $this->redirectToRoute('admin_destinations');

        if ($request->isMethod('POST')) {
            $dest->setName($request->request->get('name'));
            $dest->setCountry($request->request->get('country'));
            $dest->setCity($request->request->get('city'));
            $dest->setType($request->request->get('type'));
            $dest->setBestSeason($request->request->get('bestSeason'));
            $dest->setEstimatedBudget($request->request->get('estimatedBudget'));
            $dest->setImageUrl($request->request->get('imageUrl'));
            $dest->setDescription($request->request->get('description'));
            $dest->setLatitude($request->request->get('latitude'));
            $dest->setLongitude($request->request->get('longitude'));
            
            $this->destinationService->save($dest);
            $this->addFlash('success', 'Destination updated.');
            return $this->redirectToRoute('admin_destinations');
        }
        return $this->render('admin/destination_form.html.twig', ['target_destination' => $dest]);
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

    #[Route('/activities/add', name: 'activity_add', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function addActivity(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $act = new \App\Entity\Activity();
            $act->setName($request->request->get('name'));
            $act->setCategory($request->request->get('category'));
            $act->setPrice($request->request->get('price'));
            $act->setCurrency($request->request->get('currency', 'USD'));
            $duration = $request->request->get('durationMinutes');
            if ($duration) $act->setDurationMinutes((int)$duration);
            $capacity = $request->request->get('capacity');
            if ($capacity) $act->setCapacity((int)$capacity);
            $act->setDescription($request->request->get('description'));
            // Hardcoded dummy destination id to respect foreign key constraint if needed by DB mapping
            // Note: Since destination_id can be null or zero, we don't necessarily have to set it.
            
            $this->activityService->save($act);
            $this->addFlash('success', 'Activity added.');
            return $this->redirectToRoute('admin_activities');
        }
        return $this->render('admin/activity_form.html.twig', ['target_activity' => null]);
    }

    #[Route('/activities/edit/{id}', name: 'activity_edit', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
    public function editActivity(int $id, Request $request): Response
    {
        $act = $this->activityService->find($id);
        if (!$act) return $this->redirectToRoute('admin_activities');

        if ($request->isMethod('POST')) {
            $act->setName($request->request->get('name'));
            $act->setCategory($request->request->get('category'));
            $act->setPrice($request->request->get('price'));
            $act->setCurrency($request->request->get('currency', 'USD'));
            $duration = $request->request->get('durationMinutes');
            if ($duration !== '') $act->setDurationMinutes((int)$duration);
            $capacity = $request->request->get('capacity');
            if ($capacity !== '') $act->setCapacity((int)$capacity);
            $act->setDescription($request->request->get('description'));
            
            $this->activityService->save($act);
            $this->addFlash('success', 'Activity updated.');
            return $this->redirectToRoute('admin_activities');
        }
        return $this->render('admin/activity_form.html.twig', ['target_activity' => $act]);
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

    #[Route('/transport', name: 'transport')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_TRANSPORT')"))]
    public function transport(): Response { return $this->render('admin/transport.html.twig'); }

    #[Route('/offers', name: 'offers')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_OFFERS')"))]
    public function offers(): Response { return $this->render('admin/offers.html.twig'); }

    #[Route('/blog', name: 'blog')]
    #[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_BLOG')"))]
    public function blog(): Response { return $this->render('admin/blog/blog.html.twig'); }


}