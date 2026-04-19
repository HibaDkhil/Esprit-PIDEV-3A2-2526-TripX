<?php

namespace App\service;

use App\Entity\Offer;
use App\Entity\Pack;
use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;

/**
 * HolidayOfferSyncService
 * ───────────────────────
 * Scans all active packs, checks if their destination country has a public
 * holiday within the next LOOKAHEAD_DAYS days, and auto-creates an Offer
 * for packs that don't already have one.
 *
 * Triggered manually by the admin via the "Sync Holiday Offers" button.
 *
 * Rules:
 *  - Only creates an offer if the pack has NO currently active offer
 *  - Only creates one offer per pack per sync (first upcoming holiday wins)
 *  - Auto-generated offers are prefixed with "[AUTO]" in the title
 *    so admins can distinguish them from manually created ones
 *  - Offer runs from today until 3 days after the holiday
 *  - Default discount: 10% (PERCENTAGE)
 */
class HolidayOfferSyncService
{
    private const LOOKAHEAD_DAYS    = 15;
    private const DEFAULT_DISCOUNT  = '10.00';
    private const AUTO_PREFIX       = '[AUTO] ';

    // ISO 3166-1 alpha-2 map for common country names
    private const COUNTRY_CODE_MAP = [
        'Tunisia'              => 'TN',
        'France'               => 'FR',
        'Italy'                => 'IT',
        'Spain'                => 'ES',
        'Germany'              => 'DE',
        'United Kingdom'       => 'GB',
        'United States'        => 'US',
        'Morocco'              => 'MA',
        'Egypt'                => 'EG',
        'Turkey'               => 'TR',
        'Greece'               => 'GR',
        'Portugal'             => 'PT',
        'Netherlands'          => 'NL',
        'Switzerland'          => 'CH',
        'Japan'                => 'JP',
        'Thailand'             => 'TH',
        'United Arab Emirates' => 'AE',
        'Saudi Arabia'         => 'SA',
        'Algeria'              => 'DZ',
        'Libya'                => 'LY',
        'Jordan'               => 'JO',
        'Lebanon'              => 'LB',
        'Maldives'             => 'MV',
        'Iceland'              => 'IS',
        'Bali'                 => 'ID',
        'Indonesia'            => 'ID',
        'New York'             => 'US',
        'Berlin'               => 'DE',
        'London'               => 'GB',
        'Barcelona'            => 'ES',
        'Madrid'               => 'ES',
        'Paris'                => 'FR',
        'Rome'                 => 'IT',
        'Dubai'                => 'AE',
        'Tokyo'                => 'JP',
        'Santorini'            => 'GR',
    ];

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PackService            $packService,
        private readonly OfferService           $offerService,
        private readonly CalendarificService    $calendarificService,
        private readonly DestinationService     $destinationService,
    ) {}

    // ─────────────────────────────────────────────────────────────────────────
    //  PUBLIC
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Run the full sync. Returns a summary array.
     *
     * @return array{
     *   created: int,
     *   skipped: int,
     *   noHoliday: int,
     *   errors: int,
     *   log: string[],
     * }
     */
    public function sync(): array
    {
        $created   = 0;
        $skipped   = 0;
        $noHoliday = 0;
        $errors    = 0;
        $log       = [];

        $packs = $this->packService->getActivePacks();
        $today = new \DateTime();
        $limit = (new \DateTime())->modify('+' . self::LOOKAHEAD_DAYS . ' days');

        foreach ($packs as $pack) {
            $packId = $pack->getIdPack();

            // ── Skip if pack already has an active offer ──────────────────────
            $existing = $this->offerService->getActiveOfferForPack($packId);
            if ($existing) {
                $skipped++;
                $log[] = 'SKIP  Pack #' . $packId . ' "' . $pack->getTitle() . '" — already has offer "' . $existing->getTitle() . '"';
                continue;
            }

            // ── Resolve destination country ───────────────────────────────────
            $countryCode = $this->resolveCountryCode($pack);
            if (!$countryCode) {
                $noHoliday++;
                $log[] = 'SKIP  Pack #' . $packId . ' "' . $pack->getTitle() . '" — could not resolve country code';
                continue;
            }

            // ── Fetch holidays ────────────────────────────────────────────────
            $year     = (int) $today->format('Y');
            $result   = $this->calendarificService->getHolidays($countryCode, $year);

            if (!($result['ok'] ?? false) || empty($result['holidays'])) {
                // Try next year if we're near year end
                if ((int) $today->format('n') >= 11) {
                    $result = $this->calendarificService->getHolidays($countryCode, $year + 1);
                }
                if (!($result['ok'] ?? false) || empty($result['holidays'])) {
                    $noHoliday++;
                    $log[] = 'SKIP  Pack #' . $packId . ' "' . $pack->getTitle() . '" (' . $countryCode . ') — no holidays found or API error';
                    continue;
                }
            }

            // ── Find first holiday within LOOKAHEAD_DAYS ──────────────────────
            $upcomingHoliday = null;
            foreach ($result['holidays'] as $h) {
                $dateStr = $h['date']['iso'] ?? null;
                if (!$dateStr) continue;
                try {
                    $holidayDate = new \DateTime($dateStr);
                } catch (\Throwable) {
                    continue;
                }
                if ($holidayDate >= $today && $holidayDate <= $limit) {
                    $upcomingHoliday = ['name' => $h['name'], 'date' => $holidayDate];
                    break;
                }
            }

            if (!$upcomingHoliday) {
                $noHoliday++;
                $log[] = 'SKIP  Pack #' . $packId . ' "' . $pack->getTitle() . '" — no holiday in next ' . self::LOOKAHEAD_DAYS . ' days';
                continue;
            }

            // ── Create the offer ──────────────────────────────────────────────
            try {
                $offer = $this->createHolidayOffer($pack, $upcomingHoliday, $today);
                $this->em->persist($offer);
                $created++;
                $log[] = 'CREATED Pack #' . $packId . ' "' . $pack->getTitle() . '" — "' . $offer->getTitle() . '" until ' . $offer->getEndDate()->format('d M Y');
            } catch (\Throwable $e) {
                $errors++;
                $log[] = 'ERROR  Pack #' . $packId . ' — ' . $e->getMessage();
            }
        }

        if ($created > 0) {
            $this->em->flush();
        }

        return [
            'created'   => $created,
            'skipped'   => $skipped,
            'noHoliday' => $noHoliday,
            'errors'    => $errors,
            'log'       => $log,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  PRIVATE HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    private function createHolidayOffer(Pack $pack, array $holiday, \DateTime $today): Offer
    {
        /** @var \DateTime $holidayDate */
        $holidayDate = $holiday['date'];
        $holidayName = $holiday['name'];

        $endDate = (clone $holidayDate)->modify('+3 days');

        $offer = new Offer();
        $offer->setTitle(self::AUTO_PREFIX . $holidayName . ' Special');
        $offer->setDescription(
            'Celebrate ' . $holidayName . ' with a special discount on the "' . $pack->getTitle() . '" pack! '
            . 'Book before ' . $endDate->format('d M Y') . ' to enjoy this limited offer.'
        );
        $offer->setDiscountType('PERCENTAGE');
        $offer->setDiscountValue(self::DEFAULT_DISCOUNT);
        $offer->setPackId($pack->getIdPack());
        if ($pack->getDestinationId()) {
            $offer->setDestinationId((string) $pack->getDestinationId());
        }
        $offer->setStartDate(clone $today);
        $offer->setEndDate($endDate);
        $offer->setIsActive(true);

        return $offer;
    }

    private function resolveCountryCode(Pack $pack): ?string
    {
        // Try destination entity first
        if ($pack->getDestinationId()) {
            $dest = $this->destinationService->find($pack->getDestinationId());
            if ($dest && $dest->getCountry()) {
                $code = $this->codeFromName($dest->getCountry());
                if ($code) return $code;
                // If country IS already a 2-letter code
                if (strlen($dest->getCountry()) === 2) {
                    return strtoupper($dest->getCountry());
                }
            }
        }

        return null;
    }

    private function codeFromName(string $name): ?string
    {
        $name = trim($name);
        // Direct map lookup
        if (isset(self::COUNTRY_CODE_MAP[$name])) {
            return self::COUNTRY_CODE_MAP[$name];
        }
        // Case-insensitive fallback
        foreach (self::COUNTRY_CODE_MAP as $country => $code) {
            if (strcasecmp($country, $name) === 0) {
                return $code;
            }
        }
        return null;
    }
}
