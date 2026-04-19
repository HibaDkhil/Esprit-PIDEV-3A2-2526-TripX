<?php

namespace App\service;

use App\Entity\PacksBooking;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * PackBookingDetailsPdfService
 * ────────────────────────
 * Generates a professional, personalized booking confirmation PDF
 * for a single user booking. Triggered when QR code is scanned.
 *
 * Requires: composer require dompdf/dompdf
 */
class PackBookingDetailsPdfService
{
    public function __construct(
        private readonly PackService $packService,
    ) {}

    public function generate(PacksBooking $booking, string $userName): string
    {
        $html = $this->buildHtml($booking, $userName);

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

    private function buildHtml(PacksBooking $booking, string $userName): string
    {
        $pack        = $this->packService->find($booking->getPackId());
        $packTitle   = $pack ? htmlspecialchars($pack->getTitle()) : 'Pack #' . $booking->getPackId();
        $packDesc    = $pack ? htmlspecialchars($pack->getDescription() ?? '') : '';
        $packPrice   = $pack ? number_format((float) $pack->getBasePrice(), 2) : '--';

        $bookingId   = $booking->getIdBooking();
        $status      = $booking->getStatus();
        $bookDate    = $booking->getBookingDate()?->format('d F Y') ?? '--';
        $startDate   = $booking->getTravelStartDate()?->format('d F Y') ?? '--';
        $endDate     = $booking->getTravelEndDate()?->format('d F Y') ?? '--';
        $travelers   = $booking->getNumTravelers();
        $totalPrice  = number_format((float) $booking->getTotalPrice(), 2);
        $discount    = number_format((float) $booking->getDiscountApplied(), 2);
        $finalPrice  = number_format((float) $booking->getFinalPrice(), 2);
        $notes       = $booking->getNotes() ? htmlspecialchars($booking->getNotes()) : null;

        // Trip duration
        $duration = '--';
        if ($booking->getTravelStartDate() && $booking->getTravelEndDate()) {
            $diff     = $booking->getTravelStartDate()->diff($booking->getTravelEndDate());
            $duration = $diff->days . ' day' . ($diff->days !== 1 ? 's' : '');
        }

        // Status styling
        $statusColor = match ($status) {
            'CONFIRMED'  => '#10b981',
            'COMPLETED'  => '#6366f1',
            'CANCELLED'  => '#ef4444',
            default      => '#f59e0b',
        };
        $statusBg = match ($status) {
            'CONFIRMED'  => '#d1fae5',
            'COMPLETED'  => '#ede9fe',
            'CANCELLED'  => '#fee2e2',
            default      => '#fef3c7',
        };

        $notesHtml = $notes
            ? "<tr><td colspan='2' style='padding:14px 20px;border-top:1px solid #f1f5f9;'>
                <div style='font-size:10px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:6px;'>Travel Notes</div>
                <div style='font-size:13px;color:#374151;font-style:italic;'>\"$notes\"</div>
               </td></tr>"
            : '';

        $discountRow = (float) $booking->getDiscountApplied() > 0
            ? "<tr>
                <td style='padding:8px 20px;font-size:13px;color:#374151;'>Base Total</td>
                <td style='padding:8px 20px;text-align:right;font-size:13px;color:#374151;'>EUR $totalPrice</td>
               </tr>
               <tr>
                <td style='padding:8px 20px;font-size:13px;color:#10b981;font-weight:600;'>Discount Applied</td>
                <td style='padding:8px 20px;text-align:right;font-size:13px;color:#10b981;font-weight:600;'>- EUR $discount</td>
               </tr>"
            : '';

        $generatedAt = (new \DateTime())->format('d F Y, H:i');

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family:Helvetica,Arial,sans-serif; color:#1a1a2e; background:#fff; font-size:13px; line-height:1.5; }
  table { border-collapse:collapse; }
</style>
</head>
<body>

<!-- HEADER BAND -->
<table width="100%" style="background:#0f172a;">
  <tr>
    <td style="padding:28px 36px 22px;">
      <div style="font-size:24px;font-weight:900;letter-spacing:-1px;color:#00a6ed;margin-bottom:2px;">
        Trip<span style="color:#fff;">X</span>
      </div>
      <div style="font-size:10px;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.1em;">
        Booking Confirmation
      </div>
    </td>
    <td style="padding:28px 36px 22px;text-align:right;vertical-align:middle;">
      <span style="background:$statusBg;color:$statusColor;padding:6px 16px;border-radius:6px;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;">
        $status
      </span>
    </td>
  </tr>
</table>

<!-- ACCENT LINE -->
<div style="height:3px;background:linear-gradient(to right,#00a6ed,#10b981,#6366f1,#f59e0b);"></div>

<!-- BOOKING REFERENCE BANNER -->
<table width="100%" style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
  <tr>
    <td style="padding:18px 36px;">
      <div style="font-size:10px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:3px;">Booking Reference</div>
      <div style="font-size:22px;font-weight:900;color:#0f172a;font-family:monospace;letter-spacing:2px;">
        TRX-{$bookingId}
      </div>
    </td>
    <td style="padding:18px 36px;text-align:right;">
      <div style="font-size:10px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:3px;">Booked By</div>
      <div style="font-size:16px;font-weight:700;color:#0f172a;">$userName</div>
      <div style="font-size:11px;color:#94a3b8;">Booked on $bookDate</div>
    </td>
  </tr>
</table>

<!-- PACK INFO -->
<table width="100%" style="margin-top:24px;">
  <tr>
    <td style="padding:0 36px;">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
        <span style="color:#00a6ed;">01 /</span> Travel Package
      </div>
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid #00a6ed;border-radius:0 10px 10px 0;padding:18px 20px;">
        <div style="font-size:18px;font-weight:800;color:#0f172a;margin-bottom:6px;">$packTitle</div>
        <div style="font-size:12px;color:#6b7280;line-height:1.6;">$packDesc</div>
        <div style="margin-top:10px;font-size:11px;color:#94a3b8;">Base price per person: EUR $packPrice</div>
      </div>
    </td>
  </tr>
</table>

<!-- TRIP DETAILS -->
<table width="100%" style="margin-top:20px;">
  <tr>
    <td style="padding:0 36px;">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
        <span style="color:#00a6ed;">02 /</span> Trip Details
      </div>
    </td>
  </tr>
  <tr>
    <td style="padding:0 36px;">
      <table width="100%" style="border-collapse:separate;border-spacing:10px 0;">
        <tr>
          <td style="width:25%;vertical-align:top;">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #00a6ed;border-radius:10px;padding:14px 16px;text-align:center;">
              <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Departure</div>
              <div style="font-size:13px;font-weight:800;color:#0f172a;">$startDate</div>
            </div>
          </td>
          <td style="width:25%;vertical-align:top;">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #10b981;border-radius:10px;padding:14px 16px;text-align:center;">
              <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Return</div>
              <div style="font-size:13px;font-weight:800;color:#0f172a;">$endDate</div>
            </div>
          </td>
          <td style="width:25%;vertical-align:top;">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #6366f1;border-radius:10px;padding:14px 16px;text-align:center;">
              <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Duration</div>
              <div style="font-size:13px;font-weight:800;color:#0f172a;">$duration</div>
            </div>
          </td>
          <td style="width:25%;vertical-align:top;">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-top:3px solid #f59e0b;border-radius:10px;padding:14px 16px;text-align:center;">
              <div style="font-size:9px;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;margin-bottom:5px;">Travelers</div>
              <div style="font-size:13px;font-weight:800;color:#0f172a;">$travelers</div>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<!-- PRICE BREAKDOWN -->
<table width="100%" style="margin-top:20px;">
  <tr>
    <td style="padding:0 36px;">
      <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#94a3b8;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #e2e8f0;">
        <span style="color:#00a6ed;">03 /</span> Price Breakdown
      </div>
      <table width="100%" style="border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
        $discountRow
        <tr style="background:#0f172a;">
          <td style="padding:14px 20px;font-size:14px;font-weight:800;color:#fff;">Total Amount Due</td>
          <td style="padding:14px 20px;text-align:right;font-size:18px;font-weight:900;color:#00a6ed;">EUR $finalPrice</td>
        </tr>
        $notesHtml
      </table>
    </td>
  </tr>
</table>

<!-- IMPORTANT NOTICE -->
<table width="100%" style="margin-top:20px;">
  <tr>
    <td style="padding:0 36px;">
      <div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:10px;padding:14px 18px;">
        <div style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;color:#92400e;margin-bottom:4px;">Important Information</div>
        <div style="font-size:11px;color:#78350f;line-height:1.6;">
          Please present this confirmation at check-in. Booking reference TRX-{$bookingId} must be quoted for all communications.
          Contact TripX support for any changes or cancellations prior to your departure date.
        </div>
      </div>
    </td>
  </tr>
</table>

<!-- FOOTER -->
<table width="100%" style="margin-top:28px;border-top:1px solid #e2e8f0;">
  <tr>
    <td style="padding:14px 36px;font-size:9px;color:#94a3b8;">
      TripX &mdash; Your Journey, Our Passion &copy; {$generatedAt}
    </td>
    <td style="padding:14px 36px;font-size:9px;color:#94a3b8;text-align:right;">
      Generated: $generatedAt
    </td>
  </tr>
</table>

</body>
</html>
HTML;
    }
}
