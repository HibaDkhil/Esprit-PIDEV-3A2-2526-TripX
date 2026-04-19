<?php

namespace App\Controller\user;

use App\service\CalendarificService;
use App\service\DestinationService;
use App\service\RestCountriesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/api/packs-offers', name: 'api_packs_offers_')]
class PacksOffersApiController extends AbstractController
{
    public function __construct(
        private RestCountriesService $restCountries,
        private CalendarificService $calendarific,
        private DestinationService $destinationService
    ) {}

    #[Route('/country', name: 'country', methods: ['GET'])]
    public function country(Request $request): JsonResponse
    {
        $country = trim((string) $request->query->get('country', ''));
        $destinationId = trim((string) $request->query->get('destinationId', ''));

        if ($country === '' && $destinationId !== '') {
            $dest = $this->destinationService->find($destinationId);
            $country = $dest?->getCountry() ?? '';
        }

        if ($country === '') {
            return $this->json(['ok' => false, 'error' => 'Missing country or destinationId'], 400);
        }

        $info = $this->restCountries->getCountryByName($country);
        return $this->json([
            'ok' => $info !== null,
            'country' => $country,
            'data' => $info,
        ]);
    }

    #[Route('/holidays', name: 'holidays', methods: ['GET'])]
    public function holidays(Request $request): JsonResponse
    {
        $countryCode = (string) $request->query->get('countryCode', '');
        $year = $request->query->getInt('year', (int) date('Y'));
        $month = $request->query->get('month');

        $monthInt = null;
        if ($month !== null && $month !== '') {
            $monthInt = (int) $month;
            if ($monthInt < 1 || $monthInt > 12) {
                return $this->json(['ok' => false, 'error' => 'Invalid month'], 400);
            }
        }

        if (trim($countryCode) === '') {
            return $this->json(['ok' => false, 'error' => 'Missing countryCode'], 400);
        }

        $result = $this->calendarific->getHolidays($countryCode, $year, $monthInt);
        $holidays = $result['holidays'] ?? [];
        $envKey = (string) (getenv('CALENDARIFIC_API_KEY') ?: ($_ENV['CALENDARIFIC_API_KEY'] ?? $_SERVER['CALENDARIFIC_API_KEY'] ?? ''));

        return $this->json([
            'ok' => (bool) ($result['ok'] ?? false),
            'countryCode' => strtoupper(trim($countryCode)),
            'year' => $year,
            'month' => $monthInt,
            'count' => count($holidays),
            'holidays' => $holidays,
            'meta' => $result['meta'] ?? null,
            'error' => $result['error'] ?? null,
            'envConfigured' => $envKey !== '',
        ]);
    }
}

