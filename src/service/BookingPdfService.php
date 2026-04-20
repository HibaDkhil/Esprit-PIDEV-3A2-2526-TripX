<?php

namespace App\service;

use App\Entity\PacksBooking;
use App\Entity\PackCategory;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class BookingPdfService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PackService            $packService,
    ) {}

    // ─────────────────────────────────────────────────────────────────────────
    //  PUBLIC
    // ─────────────────────────────────────────────────────────────────────────

    public function generateReport(): string
    {
        $data = $this->collectData();
        $html = $this->buildHtml($data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  DATA
    // ─────────────────────────────────────────────────────────────────────────

    private function collectData(): array
    {
        /** @var PacksBooking[] $bookings */
        $bookings = $this->em->createQueryBuilder()
            ->select('b')
            ->from(PacksBooking::class, 'b')
            ->orderBy('b.bookingDate', 'DESC')
            ->getQuery()->getResult();

        $packMap = [];
        foreach ($this->packService->getAll() as $p) {
            $packMap[$p->getIdPack()] = $p;
        }

        $catMap = [];
        foreach ($this->em->getRepository(PackCategory::class)->findAll() as $c) {
            $catMap[$c->getIdCategory()] = $c->getName();
        }

        // Status
        $byStatus = ['PENDING' => 0, 'CONFIRMED' => 0, 'CANCELLED' => 0, 'COMPLETED' => 0];
        foreach ($bookings as $b) {
            $s = $b->getStatus();
            $byStatus[$s] = ($byStatus[$s] ?? 0) + 1;
        }

        // Revenue
        $totalRevenue = $confirmedRevenue = $totalDiscount = 0;
        foreach ($bookings as $b) {
            $price = (float) $b->getFinalPrice();
            $totalRevenue += $price;
            if (in_array($b->getStatus(), ['CONFIRMED', 'COMPLETED'])) $confirmedRevenue += $price;
            $totalDiscount += (float) $b->getDiscountApplied();
        }

        // Revenue by month (last 6)
        $revenueByMonth = [];
        $bookingsByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $label = date('M y', strtotime("-$i months"));
            $revenueByMonth[$label]  = 0;
            $bookingsByMonth[$label] = 0;
        }
        foreach ($bookings as $b) {
            if (!$b->getBookingDate()) continue;
            $label = $b->getBookingDate()->format('M y');
            if (isset($revenueByMonth[$label]))  $revenueByMonth[$label]  += (float) $b->getFinalPrice();
            if (isset($bookingsByMonth[$label])) $bookingsByMonth[$label]++;
        }

        // Top packs
        $packCounts = [];
        foreach ($bookings as $b) {
            $packCounts[$b->getPackId()] = ($packCounts[$b->getPackId()] ?? 0) + 1;
        }
        arsort($packCounts);
        $topPacks = array_slice($packCounts, 0, 5, true);

        // Categories
        $catCounts = [];
        foreach ($bookings as $b) {
            $pack = $packMap[$b->getPackId()] ?? null;
            if (!$pack) continue;
            $catId   = $pack->getCategoryId() ?? 0;
            $catName = $catMap[$catId] ?? 'Other';
            $catCounts[$catName] = ($catCounts[$catName] ?? 0) + 1;
        }
        arsort($catCounts);

        $totalTravelers = array_sum(array_map(fn($b) => (int) $b->getNumTravelers(), $bookings));
        $avgTravelers   = count($bookings) > 0 ? round($totalTravelers / count($bookings), 1) : 0;

        return [
            'generatedAt'      => new \DateTime(),
            'total'            => count($bookings),
            'byStatus'         => $byStatus,
            'totalRevenue'     => $totalRevenue,
            'confirmedRevenue' => $confirmedRevenue,
            'totalDiscount'    => $totalDiscount,
            'revenueByMonth'   => $revenueByMonth,
            'bookingsByMonth'  => $bookingsByMonth,
            'topPacks'         => $topPacks,
            'catCounts'        => $catCounts,
            'avgTravelers'     => $avgTravelers,
            'totalTravelers'   => $totalTravelers,
            'recent'           => array_slice($bookings, 0, 10),
            'packMap'          => $packMap,
            'catMap'           => $catMap,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  HTML BUILDER
    // ─────────────────────────────────────────────────────────────────────────

    private function buildHtml(array $d): string
    {
        $date      = $d['generatedAt']->format('d F Y, H:i');
        $total     = $d['total'];
        $totalRev  = number_format($d['totalRevenue'], 2);
        $confRev   = number_format($d['confirmedRevenue'], 2);
        $discounts = number_format($d['totalDiscount'], 2);
        $avgTrav   = $d['avgTravelers'];
        $totalTrav = $d['totalTravelers'];

        $statusChart  = $this->buildStatusChart($d['byStatus'], $total);
        $catChart     = $this->buildHBarChart($d['catCounts'], ['#00a6ed','#10b981','#6366f1','#f59e0b','#ef4444','#8b5cf6']);
        $revenueChart = $this->buildVBarChart($d['revenueByMonth'], '#00a6ed', true);
        $bookingChart = $this->buildVBarChart($d['bookingsByMonth'], '#10b981', false);

        // Top packs rows
        $topPackRows = '';
        $rank = 1;
        foreach ($d['topPacks'] as $packId => $count) {
            $pack    = $d['packMap'][$packId] ?? null;
            $title   = $pack ? htmlspecialchars($pack->getTitle()) : 'Pack #' . $packId;
            $price   = $pack ? 'EUR ' . number_format((float) $pack->getBasePrice(), 0) : '--';
            $bg      = $rank === 1 ? '#fffbeb' : ($rank % 2 === 0 ? '#f8fafc' : '#fff');
            $rankLabel = match ($rank) { 1 => '1st', 2 => '2nd', 3 => '3rd', default => $rank . 'th' };
            $rankColor = match ($rank) { 1 => '#f59e0b', 2 => '#94a3b8', 3 => '#b45309', default => '#6b7280' };
            $topPackRows .= "
            <tr style='background:$bg;'>
                <td style='padding:10px 14px;font-weight:800;color:$rankColor;font-size:13px;'>$rankLabel</td>
                <td style='padding:10px 14px;font-weight:600;font-size:13px;'>$title</td>
                <td style='padding:10px 14px;text-align:center;font-weight:800;color:#00a6ed;font-size:14px;'>$count</td>
                <td style='padding:10px 14px;text-align:right;color:#6b7280;font-size:12px;'>$price</td>
            </tr>";
            $rank++;
        }

        // Recent bookings rows
        $recentRows = '';
        foreach ($d['recent'] as $b) {
            $packTitle   = isset($d['packMap'][$b->getPackId()]) ? htmlspecialchars($d['packMap'][$b->getPackId()]->getTitle()) : 'Pack #' . $b->getPackId();
            $status      = $b->getStatus();
            $statusColor = match ($status) { 'CONFIRMED' => '#10b981', 'COMPLETED' => '#6366f1', 'CANCELLED' => '#ef4444', default => '#f59e0b' };
            $statusBg    = match ($status) { 'CONFIRMED' => '#d1fae5', 'COMPLETED' => '#e0e7ff', 'CANCELLED' => '#fee2e2', default => '#fef3c7' };
            $bdate       = $b->getBookingDate() ? $b->getBookingDate()->format('d M Y') : '--';
            $price       = 'EUR ' . number_format((float) $b->getFinalPrice(), 2);
            $recentRows .= "
            <tr>
                <td style='padding:8px 10px;font-family:monospace;font-size:10px;color:#94a3b8;'>#" . $b->getIdBooking() . "</td>
                <td style='padding:8px 10px;font-weight:600;font-size:11px;'>$packTitle</td>
                <td style='padding:8px 10px;font-size:11px;color:#6b7280;'>User #" . $b->getUserId() . "</td>
                <td style='padding:8px 10px;font-size:11px;'>$bdate</td>
                <td style='padding:8px 10px;font-weight:700;color:#00a6ed;font-size:11px;'>$price</td>
                <td style='padding:8px 10px;'>
                    <span style='background:$statusBg;color:$statusColor;padding:3px 8px;border-radius:4px;font-size:9px;font-weight:800;'>$status</span>
                </td>
            </tr>";
        }

        $year = $d['generatedAt']->format('Y');

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family:Helvetica,Arial,sans-serif; color:#1a1a2e; background:#fff; font-size:12px; line-height:1.4; }
  table { border-collapse:collapse; }
  .data-table { width:100%; border-collapse:collapse; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; }
  .data-table th { background:#0f172a; color:#fff; padding:9px 12px; font-size:10px; text-transform:uppercase; letter-spacing:0.08em; text-align:left; }
  .data-table td { border-bottom:1px solid #f1f5f9; vertical-align:middle; }
  .data-table tr:last-child td { border-bottom:none; }
</style>
</head>
<body>

<!-- HEADER -->
<table width="100%" style="background:#0f172a;margin-bottom:0;">
  <tr>
    <td style="padding:30px 36px 24px;">
      <div style="font-size:26px;font-weight:900;letter-spacing:-1px;color:#00a6ed;margin-bottom:2px;">Trip<span style="color:#fff;">X</span></div>
      <div style="font-size:11px;color:rgba(255,255,255,0.45);margin-bottom:16px;letter-spacing:0.05em;text-transform:uppercase;">Admin Analytics Report</div>
      <div style="font-size:20px;font-weight:700;color:#fff;margin-bottom:3px;">Pack Bookings Report</div>
      <div style="font-size:11px;color:rgba(255,255,255,0.45);">Generated on $date</div>
    </td>
    <td style="padding:30px 36px 24px;text-align:right;vertical-align:top;">
      <div style="display:inline-block;background:rgba(0,166,237,0.15);border:1px solid rgba(0,166,237,0.4);border-radius:10px;padding:12px 22px;text-align:center;">
        <div style="font-size:36px;font-weight:900;color:#00a6ed;line-height:1;">$total</div>
        <div style="font-size:10px;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.08em;margin-top:2px;">Total Bookings</div>
      </div>
    </td>
  </tr>
</table>

<!-- ACCENT LINE -->
<div style="height:3px;background:linear-gradient(to right,#00a6ed,#10b981,#6366f1,#f59e0b);"></div>

<!-- KPI CARDS -->
<table width="100%" style="padding:20px 36px;border-spacing:0;">
  <tr>
    <td style="padding:20px 36px 0 36px;" colspan="4">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
        Key Performance Indicators
      </div>
    </td>
  </tr>
  <tr>
    <td style="padding:0 8px 0 36px;width:25%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #00a6ed;border-radius:10px;padding:14px 16px;">
        <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Total Revenue</div>
        <div style="font-size:19px;font-weight:800;color:#0f172a;line-height:1;">EUR $totalRev</div>
        <div style="font-size:10px;color:#94a3b8;margin-top:4px;">All bookings combined</div>
      </div>
    </td>
    <td style="padding:0 8px;width:25%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #10b981;border-radius:10px;padding:14px 16px;">
        <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Confirmed Revenue</div>
        <div style="font-size:19px;font-weight:800;color:#0f172a;line-height:1;">EUR $confRev</div>
        <div style="font-size:10px;color:#94a3b8;margin-top:4px;">Confirmed + Completed</div>
      </div>
    </td>
    <td style="padding:0 8px;width:25%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #6366f1;border-radius:10px;padding:14px 16px;">
        <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Discounts Given</div>
        <div style="font-size:19px;font-weight:800;color:#0f172a;line-height:1;">EUR $discounts</div>
        <div style="font-size:10px;color:#94a3b8;margin-top:4px;">Loyalty + Offers combined</div>
      </div>
    </td>
    <td style="padding:0 36px 0 8px;width:25%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #f59e0b;border-radius:10px;padding:14px 16px;">
        <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Avg Travelers / Booking</div>
        <div style="font-size:19px;font-weight:800;color:#0f172a;line-height:1;">$avgTrav</div>
        <div style="font-size:10px;color:#94a3b8;margin-top:4px;">$totalTrav total travelers</div>
      </div>
    </td>
  </tr>
</table>

<!-- SECTION 01: STATUS + CATEGORY -->
<table width="100%" style="margin-top:20px;">
  <tr>
    <td style="padding:0 36px;" colspan="2">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
        <span style="color:#00a6ed;">01 /</span> Booking Status &amp; Category Breakdown
      </div>
    </td>
  </tr>
  <tr>
    <td style="padding:0 8px 0 36px;width:50%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;">
        <div style="font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;margin-bottom:12px;">Bookings by Status</div>
        $statusChart
      </div>
    </td>
    <td style="padding:0 36px 0 8px;width:50%;vertical-align:top;">
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;">
        <div style="font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;margin-bottom:12px;">Bookings by Category</div>
        $catChart
      </div>
    </td>
  </tr>
</table>

<!-- SECTION 02: REVENUE CHART -->
<table width="100%" style="margin-top:20px;">
  <tr><td style="padding:0 36px;" colspan="1">
    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
      <span style="color:#00a6ed;">02 /</span> Revenue Trend — Last 6 Months
    </div>
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px 20px;">
      $revenueChart
    </div>
  </td></tr>
</table>

<!-- SECTION 03: BOOKING VOLUME -->
<table width="100%" style="margin-top:20px;">
  <tr><td style="padding:0 36px;" colspan="1">
    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
      <span style="color:#00a6ed;">03 /</span> Booking Volume — Last 6 Months
    </div>
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px 20px;">
      $bookingChart
    </div>
  </td></tr>
</table>

<!-- SECTION 04: TOP PACKS -->
<table width="100%" style="margin-top:20px;">
  <tr><td style="padding:0 36px;">
    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
      <span style="color:#00a6ed;">04 /</span> Top 5 Most Booked Packs
    </div>
    <table class="data-table">
      <thead><tr>
        <th style="width:8%;">Rank</th>
        <th>Pack Title</th>
        <th style="text-align:center;width:14%;">Bookings</th>
        <th style="text-align:right;width:16%;">Base Price</th>
      </tr></thead>
      <tbody>$topPackRows</tbody>
    </table>
  </td></tr>
</table>

<!-- SECTION 05: RECENT BOOKINGS -->
<table width="100%" style="margin-top:20px;">
  <tr><td style="padding:0 36px;">
    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
      <span style="color:#00a6ed;">05 /</span> 10 Most Recent Bookings
    </div>
    <table class="data-table">
      <thead><tr>
        <th>ID</th><th>Pack</th><th>User</th><th>Date</th><th>Final Price</th><th>Status</th>
      </tr></thead>
      <tbody>$recentRows</tbody>
    </table>
  </td></tr>
</table>

<!-- FOOTER -->
<table width="100%" style="margin-top:28px;border-top:1px solid #e2e8f0;">
  <tr>
    <td style="padding:14px 36px;font-size:9px;color:#94a3b8;">TripX Admin — Confidential Report &copy; $year. For internal use only.</td>
    <td style="padding:14px 36px;font-size:9px;color:#94a3b8;text-align:right;">Generated: $date</td>
  </tr>
</table>

</body>
</html>
HTML;
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  CHART BUILDERS — pure HTML/CSS, no SVG, Dompdf-safe
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Status breakdown: a coloured segmented bar + legend rows below.
     */
    private function buildStatusChart(array $byStatus, int $total): string
    {
        $colors = ['PENDING' => '#f59e0b', 'CONFIRMED' => '#10b981', 'CANCELLED' => '#ef4444', 'COMPLETED' => '#6366f1'];
        $bgs    = ['PENDING' => '#fef3c7', 'CONFIRMED' => '#d1fae5', 'CANCELLED' => '#fee2e2', 'COMPLETED' => '#e0e7ff'];

        // Segmented bar
        $bar = '<table width="100%" style="border-collapse:collapse;border-radius:6px;overflow:hidden;height:22px;margin-bottom:14px;"><tr>';
        foreach ($byStatus as $status => $count) {
            if ($count === 0 || $total === 0) continue;
            $pct = round(($count / $total) * 100);
            $bar .= "<td width='{$pct}%' style='background:{$colors[$status]};height:22px;'></td>";
        }
        $bar .= '</tr></table>';

        // Legend
        $legend = '<table width="100%" style="border-collapse:collapse;">';
        foreach ($byStatus as $status => $count) {
            $pct = $total > 0 ? round(($count / $total) * 100) : 0;
            $legend .= "
            <tr>
              <td style='padding:5px 0;width:14px;'>
                <div style='width:12px;height:12px;border-radius:3px;background:{$colors[$status]};'></div>
              </td>
              <td style='padding:5px 6px;font-size:11px;color:#374151;font-weight:600;'>$status</td>
              <td style='padding:5px 0;font-size:11px;color:#6b7280;'>$count bookings</td>
              <td style='padding:5px 0;text-align:right;'>
                <span style='background:{$bgs[$status]};color:{$colors[$status]};padding:2px 8px;border-radius:4px;font-size:10px;font-weight:700;'>$pct%</span>
              </td>
            </tr>";
        }
        $legend .= '</table>';

        return $bar . $legend;
    }

    /**
     * Horizontal bar chart — for categories.
     */
    private function buildHBarChart(array $data, array $colors): string
    {
        if (empty($data)) {
            return '<p style="color:#94a3b8;font-size:11px;">No data available.</p>';
        }

        $max   = max(array_values($data));
        $total = array_sum($data);
        $html  = '<table width="100%" style="border-collapse:collapse;">';
        $i     = 0;

        foreach ($data as $label => $value) {
            $pct      = $max > 0 ? round(($value / $max) * 100) : 0;
            $sharePct = $total > 0 ? round(($value / $total) * 100) : 0;
            $color    = $colors[$i % count($colors)];
            $short    = mb_strlen($label) > 14 ? mb_substr($label, 0, 14) . '...' : $label;

            $html .= "
            <tr>
              <td style='padding:4px 8px 4px 0;width:90px;font-size:10px;color:#374151;font-weight:600;text-align:right;'>$short</td>
              <td style='padding:4px 0;'>
                <table width='100%' style='border-collapse:collapse;'>
                  <tr>
                    <td style='background:#e2e8f0;border-radius:4px;height:18px;padding:0;'>
                      <div style='width:{$pct}%;background:$color;height:18px;border-radius:4px;min-width:4px;'></div>
                    </td>
                  </tr>
                </table>
              </td>
              <td style='padding:4px 0 4px 8px;width:60px;font-size:10px;color:#6b7280;white-space:nowrap;'>$value ($sharePct%)</td>
            </tr>";
            $i++;
        }

        $html .= '</table>';
        return $html;
    }

    /**
     * Vertical bar chart — for revenue and booking volume trends.
     * Rendered as a table of columns with bars growing upward (simulated with padding-top).
     */
    private function buildVBarChart(array $data, string $color, bool $isCurrency): string
    {
        if (empty($data)) return '<p style="color:#94a3b8;">No data.</p>';

        $values  = array_values($data);
        $labels  = array_keys($data);
        $max     = max(array_merge($values, [1]));
        $barH    = 80; // total chart height in px
        $colW    = floor(100 / count($labels));

        $html  = '<table width="100%" style="border-collapse:collapse;height:' . ($barH + 40) . 'px;">';
        $html .= '<tr style="vertical-align:bottom;height:' . $barH . 'px;">';

        foreach ($values as $i => $val) {
            $fillPct  = $max > 0 ? round(($val / $max) * $barH) : 0;
            $emptyPx  = $barH - $fillPct;
            $display  = $val > 0
                ? ($isCurrency ? 'EUR ' . number_format($val, 0) : (string) $val)
                : '0';

            $html .= "<td width='{$colW}%' style='text-align:center;vertical-align:bottom;padding:0 3px;'>
                <div style='font-size:8px;color:#374151;font-weight:700;margin-bottom:3px;'>$display</div>
                <div style='height:{$fillPct}px;background:$color;border-radius:3px 3px 0 0;min-height:" . ($val > 0 ? '4' : '0') . "px;'></div>
            </td>";
        }

        $html .= '</tr>';

        // Labels row
        $html .= '<tr>';
        foreach ($labels as $label) {
            $html .= "<td width='{$colW}%' style='text-align:center;padding:5px 2px 0;font-size:9px;color:#6b7280;border-top:1px solid #e2e8f0;'>$label</td>";
        }
        $html .= '</tr></table>';

        return $html;
    }
}
