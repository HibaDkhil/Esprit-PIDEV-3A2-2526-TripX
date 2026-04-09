<?php

namespace App\Controller\user;

use App\Entity\Activity;
use App\Entity\PriceAlert;
use App\Entity\User;
use App\service\PricePredictionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PricePredictionController extends AbstractController
{
    #[Route('/price-dashboard', name: 'price_dashboard')]
    public function dashboard(PricePredictionService $pricePredictionService): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $uid = $user instanceof User ? $user->getUserId() : null;
        $payload = $pricePredictionService->buildDashboardPayload($uid);

        return $this->render('front/price_dashboard.html.twig', $payload);
    }

    /**
     * Saves a “wait for drop” alert (MVP: stored in DB; no real email until a notifier is wired).
     */
    #[Route('/api/price-alert', name: 'api_price_alert', methods: ['POST'])]
    public function createPriceAlert(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return new JsonResponse(['ok' => false, 'error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true) ?? [];
        $token = $request->headers->get('X-CSRF-TOKEN')
            ?? ($data['_csrf_token'] ?? $data['csrf_token'] ?? '');
        if (!$this->isCsrfTokenValid('price_alert', (string) $token)) {
            return new JsonResponse(['ok' => false, 'error' => 'Invalid CSRF'], 403);
        }
        $activityId = isset($data['activityId']) ? (string) $data['activityId'] : '';
        if ($activityId === '') {
            return new JsonResponse(['ok' => false, 'error' => 'Missing activity'], 400);
        }

        $activity = $em->find(Activity::class, $activityId);
        if (!$activity) {
            return new JsonResponse(['ok' => false, 'error' => 'Activity not found'], 404);
        }

        $targetRaw = $data['targetPrice'] ?? $activity->getPrice() ?? 0;
        $target = is_numeric($targetRaw) ? (float) $targetRaw : 0.0;
        if ($target <= 0) {
            $target = 49.0;
        }

        $uid = $user->getUserId();
        if ($uid === null) {
            return new JsonResponse(['ok' => false, 'error' => 'User id missing'], 401);
        }

        $existing = $em->getRepository(PriceAlert::class)->findOneBy([
            'userId' => $uid,
            'activityId' => $activityId,
            'isActive' => true,
        ]);
        if ($existing) {
            $existing->setTargetPrice(number_format($target, 2, '.', ''));
            $existing->setDirection('down');
            $em->flush();

            return new JsonResponse(['ok' => true, 'id' => $existing->getId(), 'updated' => true]);
        }

        $alert = new PriceAlert();
        $alert->setUserId($uid);
        $alert->setActivityId($activityId);
        $alert->setTargetPrice(number_format($target, 2, '.', ''));
        $alert->setDirection('down');
        $em->persist($alert);
        $em->flush();

        return new JsonResponse(['ok' => true, 'id' => $alert->getId(), 'updated' => false]);
    }

    /**
     * Lightweight poll for in-app banners when a listed price hits the user’s alert target.
     * Works on any page while logged in. (Email/push can use the same condition later.)
     */
    #[Route('/api/price-alerts/feed', name: 'api_price_alerts_feed', methods: ['GET'])]
    public function feedAlerts(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return new JsonResponse(['message' => null, 'sig' => null]);
        }

        $uid = $user->getUserId();
        if ($uid === null) {
            return new JsonResponse(['message' => null, 'sig' => null]);
        }

        $alerts = $em->getRepository(PriceAlert::class)->findBy(['userId' => $uid, 'isActive' => true]);
        if ($alerts === []) {
            return new JsonResponse(['message' => null, 'sig' => null]);
        }

        $session = $request->getSession();
        /** @var list<string> $shown */
        $shown = $session->get('price_feed_sigs', []);

        foreach ($alerts as $alert) {
            $act = $em->find(Activity::class, $alert->getActivityId());
            if (!$act) {
                continue;
            }
            $price = (float) $act->getPrice();
            $target = (float) $alert->getTargetPrice();
            if ($alert->getDirection() === 'down' && $price > 0 && $price <= $target) {
                $sig = 'hit-' . (string) ($alert->getId() ?? '0') . '-' . (string) round($price, 2);
                if (!in_array($sig, $shown, true)) {
                    $shown[] = $sig;
                    $session->set('price_feed_sigs', array_slice($shown, -30));

                    return new JsonResponse([
                        'message' => sprintf(
                            'Price alert: "%s" is now at or below your target (current $%s).',
                            $act->getName(),
                            number_format($price, 2)
                        ),
                        'sig' => $sig,
                    ]);
                }
            }
        }

        return new JsonResponse(['message' => null, 'sig' => null]);
    }
}
