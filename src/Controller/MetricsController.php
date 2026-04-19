<?php

namespace App\Controller;

use App\Repository\AccommodationRepository;
use App\Repository\RoomRepository;
use App\Repository\RoomImagesRepository;
use App\Repository\BookingAccRepository;
use App\Repository\AdminNotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/metrics', name: 'metrics_')]
class MetricsController extends AbstractController
{
    public function __construct(
        private AccommodationRepository $accommodationRepo,
        private RoomRepository $roomRepo,
        private RoomImagesRepository $roomImagesRepo,
        private BookingAccRepository $bookingRepo,
        private AdminNotificationRepository $notificationRepo
    ) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $metrics = [];
        
        // ============================================
        // 1. PHP & SYSTEM INFO
        // ============================================
        $metrics[] = '# HELP php_info PHP environment information';
        $metrics[] = '# TYPE php_info gauge';
        $metrics[] = sprintf('php_info{version="%s",sapi="%s"} 1', PHP_VERSION, php_sapi_name());
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_system_info System information';
        $metrics[] = '# TYPE tripx_system_info gauge';
        $metrics[] = sprintf('tripx_system_info{os="%s",hostname="%s"} 1', PHP_OS, gethostname());
        $metrics[] = '';
        
        // ============================================
        // 2. ACCOMMODATION METRICS (Detailed)
        // ============================================
        $stats = $this->accommodationRepo->getStats();
        $allAccommodations = $this->accommodationRepo->findAll();
        
        // Basic counts
        $metrics[] = '# HELP tripx_accommodations_total Total number of accommodations';
        $metrics[] = '# TYPE tripx_accommodations_total gauge';
        $metrics[] = sprintf('tripx_accommodations_total %d', $stats['total']);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_accommodations_active Active accommodations';
        $metrics[] = '# TYPE tripx_accommodations_active gauge';
        $metrics[] = sprintf('tripx_accommodations_active %d', $stats['active']);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_accommodations_inactive Inactive accommodations';
        $metrics[] = '# TYPE tripx_accommodations_inactive gauge';
        $metrics[] = sprintf('tripx_accommodations_inactive %d', $stats['inactive']);
        $metrics[] = '';
        
        // Advanced metrics
        $activeRatio = $stats['total'] > 0 ? ($stats['active'] / $stats['total']) * 100 : 0;
        $metrics[] = '# HELP tripx_accommodations_active_ratio Active accommodations ratio (%)';
        $metrics[] = '# TYPE tripx_accommodations_active_ratio gauge';
        $metrics[] = sprintf('tripx_accommodations_active_ratio %.2f', $activeRatio);
        $metrics[] = '';
        
        // Star rating distribution
        $metrics[] = '# HELP tripx_accommodations_by_stars Accommodations grouped by star rating';
        $metrics[] = '# TYPE tripx_accommodations_by_stars gauge';
        for ($i = 1; $i <= 5; $i++) {
            $count = $this->accommodationRepo->count(['stars' => $i]);
            $metrics[] = sprintf('tripx_accommodations_by_stars{stars="%d"} %d', $i, $count);
        }
        $metrics[] = '';
        
        // Accommodation by type
        $types = ['Hotel', 'Resort', 'Villa', 'Hostel', 'Apartment', 'Guest House', 'Boutique', 'Motel'];
        $metrics[] = '# HELP tripx_accommodations_by_type Accommodations grouped by type';
        $metrics[] = '# TYPE tripx_accommodations_by_type gauge';
        foreach ($types as $type) {
            $count = $this->accommodationRepo->count(['type' => $type]);
            if ($count > 0) {
                $metrics[] = sprintf('tripx_accommodations_by_type{type="%s"} %d', $type, $count);
            }
        }
        $metrics[] = '';
        
        // Average rating
        $totalRating = 0;
        $ratedCount = 0;
        foreach ($allAccommodations as $acc) {
            if ($acc->getRating() !== null) {
                $totalRating += $acc->getRating();
                $ratedCount++;
            }
        }
        $avgRating = $ratedCount > 0 ? $totalRating / $ratedCount : 0;
        $metrics[] = '# HELP tripx_accommodations_avg_rating Average accommodation rating';
        $metrics[] = '# TYPE tripx_accommodations_avg_rating gauge';
        $metrics[] = sprintf('tripx_accommodations_avg_rating %.2f', $avgRating);
        $metrics[] = '';
        
        // ============================================
        // 3. ROOM METRICS (Detailed)
        // ============================================
        $rooms = $this->roomRepo->findAll();
        $totalRooms = count($rooms);
        $availableRooms = 0;
        $unavailableRooms = 0;
        $roomsWithoutImages = 0;
        $roomsWithPriceAnomaly = 0;
        $roomsWithPrimaryImage = 0;
        $prices = [];
        
        foreach ($rooms as $room) {
            if ($room->isAvailable()) {
                $availableRooms++;
            } else {
                $unavailableRooms++;
            }
            
            $price = $room->getPricePerNight();
            if ($price !== null) {
                $prices[] = $price;
                if ($price > 5000 || ($price < 10 && $price > 0)) {
                    $roomsWithPriceAnomaly++;
                }
            }
            
            $images = $this->roomImagesRepo->findBy(['room' => $room]);
            $imageCount = count($images);
            if ($imageCount === 0) {
                $roomsWithoutImages++;
            } else {
                $hasPrimary = false;
                foreach ($images as $img) {
                    if ($img->isPrimary()) {
                        $hasPrimary = true;
                        $roomsWithPrimaryImage++;
                        break;
                    }
                }
            }
        }
        
        $avgPrice = !empty($prices) ? array_sum($prices) / count($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPrice = !empty($prices) ? max($prices) : 0;
        
        $metrics[] = '# HELP tripx_rooms_total Total number of rooms';
        $metrics[] = '# TYPE tripx_rooms_total gauge';
        $metrics[] = sprintf('tripx_rooms_total %d', $totalRooms);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_available Available rooms';
        $metrics[] = '# TYPE tripx_rooms_available gauge';
        $metrics[] = sprintf('tripx_rooms_available %d', $availableRooms);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_unavailable Unavailable rooms';
        $metrics[] = '# TYPE tripx_rooms_unavailable gauge';
        $metrics[] = sprintf('tripx_rooms_unavailable %d', $unavailableRooms);
        $metrics[] = '';
        
        $availabilityRatio = $totalRooms > 0 ? ($availableRooms / $totalRooms) * 100 : 0;
        $metrics[] = '# HELP tripx_rooms_availability_ratio Room availability ratio (%)';
        $metrics[] = '# TYPE tripx_rooms_availability_ratio gauge';
        $metrics[] = sprintf('tripx_rooms_availability_ratio %.2f', $availabilityRatio);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_without_images Rooms without any images';
        $metrics[] = '# TYPE tripx_rooms_without_images gauge';
        $metrics[] = sprintf('tripx_rooms_without_images %d', $roomsWithoutImages);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_with_primary_image Rooms with primary image set';
        $metrics[] = '# TYPE tripx_rooms_with_primary_image gauge';
        $metrics[] = sprintf('tripx_rooms_with_primary_image %d', $roomsWithPrimaryImage);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_price_anomaly Rooms with price anomalies';
        $metrics[] = '# TYPE tripx_rooms_price_anomaly gauge';
        $metrics[] = sprintf('tripx_rooms_price_anomaly %d', $roomsWithPriceAnomaly);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_avg_price Average room price per night (€)';
        $metrics[] = '# TYPE tripx_rooms_avg_price gauge';
        $metrics[] = sprintf('tripx_rooms_avg_price %.2f', $avgPrice);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_min_price Minimum room price per night (€)';
        $metrics[] = '# TYPE tripx_rooms_min_price gauge';
        $metrics[] = sprintf('tripx_rooms_min_price %.2f', $minPrice);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_rooms_max_price Maximum room price per night (€)';
        $metrics[] = '# TYPE tripx_rooms_max_price gauge';
        $metrics[] = sprintf('tripx_rooms_max_price %.2f', $maxPrice);
        $metrics[] = '';
        
        // Rooms by type
        $roomTypes = ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Deluxe Room', 'Penthouse', 'Studio'];
        $metrics[] = '# HELP tripx_rooms_by_type Rooms grouped by type';
        $metrics[] = '# TYPE tripx_rooms_by_type gauge';
        foreach ($roomTypes as $type) {
            $count = $this->roomRepo->count(['roomType' => $type]);
            if ($count > 0) {
                $metrics[] = sprintf('tripx_rooms_by_type{type="%s"} %d', $type, $count);
            }
        }
        $metrics[] = '';
        
        // ============================================
        // 4. BOOKING METRICS (Professional)
        // ============================================
        $confirmedBookings = $this->bookingRepo->count(['status' => 'CONFIRMED']);
        $pendingBookings = $this->bookingRepo->count(['status' => 'PENDING']);
        $cancelledBookings = $this->bookingRepo->count(['status' => 'CANCELLED']);
        $rejectedBookings = $this->bookingRepo->count(['status' => 'REJECTED']);
        
        $revenue = $this->bookingRepo->getFilteredRevenue('CONFIRMED');
        
        // Time-based metrics
        $now = new \DateTime();
        $today = new \DateTime('today');
        $weekAgo = new \DateTime('-7 days');
        $monthAgo = new \DateTime('-30 days');
        $yearAgo = new \DateTime('-365 days');
        
        $bookingsToday = $this->bookingRepo->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->where('b.createdAt >= :date')
            ->setParameter('date', $today)
            ->getQuery()
            ->getSingleScalarResult();
        
        $bookingsThisWeek = $this->bookingRepo->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->where('b.createdAt >= :date')
            ->setParameter('date', $weekAgo)
            ->getQuery()
            ->getSingleScalarResult();
        
        $bookingsThisMonth = $this->bookingRepo->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->where('b.createdAt >= :date')
            ->setParameter('date', $monthAgo)
            ->getQuery()
            ->getSingleScalarResult();
        
        $bookingsThisYear = $this->bookingRepo->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->where('b.createdAt >= :date')
            ->setParameter('date', $yearAgo)
            ->getQuery()
            ->getSingleScalarResult();
        
        // Revenue by period
        $revenueToday = $this->bookingRepo->createQueryBuilder('b')
            ->select('SUM(b.totalPrice)')
            ->where('b.status = :status')
            ->andWhere('b.createdAt >= :date')
            ->setParameter('status', 'CONFIRMED')
            ->setParameter('date', $today)
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
        
        $revenueThisWeek = $this->bookingRepo->createQueryBuilder('b')
            ->select('SUM(b.totalPrice)')
            ->where('b.status = :status')
            ->andWhere('b.createdAt >= :date')
            ->setParameter('status', 'CONFIRMED')
            ->setParameter('date', $weekAgo)
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
        
        $revenueThisMonth = $this->bookingRepo->createQueryBuilder('b')
            ->select('SUM(b.totalPrice)')
            ->where('b.status = :status')
            ->andWhere('b.createdAt >= :date')
            ->setParameter('status', 'CONFIRMED')
            ->setParameter('date', $monthAgo)
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
        
        $revenueThisYear = $this->bookingRepo->createQueryBuilder('b')
            ->select('SUM(b.totalPrice)')
            ->where('b.status = :status')
            ->andWhere('b.createdAt >= :date')
            ->setParameter('status', 'CONFIRMED')
            ->setParameter('date', $yearAgo)
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
        
        // Basic booking counts
        $metrics[] = '# HELP tripx_bookings_confirmed Confirmed bookings';
        $metrics[] = '# TYPE tripx_bookings_confirmed gauge';
        $metrics[] = sprintf('tripx_bookings_confirmed %d', $confirmedBookings);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_pending Pending bookings';
        $metrics[] = '# TYPE tripx_bookings_pending gauge';
        $metrics[] = sprintf('tripx_bookings_pending %d', $pendingBookings);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_cancelled Cancelled bookings';
        $metrics[] = '# TYPE tripx_bookings_cancelled gauge';
        $metrics[] = sprintf('tripx_bookings_cancelled %d', $cancelledBookings);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_rejected Rejected bookings';
        $metrics[] = '# TYPE tripx_bookings_rejected gauge';
        $metrics[] = sprintf('tripx_bookings_rejected %d', $rejectedBookings);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_total_active Total active bookings';
        $metrics[] = '# TYPE tripx_bookings_total_active gauge';
        $metrics[] = sprintf('tripx_bookings_total_active %d', $confirmedBookings + $pendingBookings);
        $metrics[] = '';
        
        // Revenue metrics
        $metrics[] = '# HELP tripx_bookings_revenue_total Total confirmed booking revenue (€)';
        $metrics[] = '# TYPE tripx_bookings_revenue_total gauge';
        $metrics[] = sprintf('tripx_bookings_revenue_total %.2f', $revenue);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_revenue_today Revenue today (€)';
        $metrics[] = '# TYPE tripx_bookings_revenue_today gauge';
        $metrics[] = sprintf('tripx_bookings_revenue_today %.2f', $revenueToday);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_revenue_7d Revenue last 7 days (€)';
        $metrics[] = '# TYPE tripx_bookings_revenue_7d gauge';
        $metrics[] = sprintf('tripx_bookings_revenue_7d %.2f', $revenueThisWeek);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_revenue_30d Revenue last 30 days (€)';
        $metrics[] = '# TYPE tripx_bookings_revenue_30d gauge';
        $metrics[] = sprintf('tripx_bookings_revenue_30d %.2f', $revenueThisMonth);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_revenue_365d Revenue last 365 days (€)';
        $metrics[] = '# TYPE tripx_bookings_revenue_365d gauge';
        $metrics[] = sprintf('tripx_bookings_revenue_365d %.2f', $revenueThisYear);
        $metrics[] = '';
        
        // Booking volume metrics
        $metrics[] = '# HELP tripx_bookings_created_today Bookings created today';
        $metrics[] = '# TYPE tripx_bookings_created_today gauge';
        $metrics[] = sprintf('tripx_bookings_created_today %d', $bookingsToday);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_created_7d Bookings created last 7 days';
        $metrics[] = '# TYPE tripx_bookings_created_7d gauge';
        $metrics[] = sprintf('tripx_bookings_created_7d %d', $bookingsThisWeek);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_created_30d Bookings created last 30 days';
        $metrics[] = '# TYPE tripx_bookings_created_30d gauge';
        $metrics[] = sprintf('tripx_bookings_created_30d %d', $bookingsThisMonth);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_bookings_created_365d Bookings created last 365 days';
        $metrics[] = '# TYPE tripx_bookings_created_365d gauge';
        $metrics[] = sprintf('tripx_bookings_created_365d %d', $bookingsThisYear);
        $metrics[] = '';
        
        // Conversion rate
        $totalBookings = $confirmedBookings + $pendingBookings + $cancelledBookings + $rejectedBookings;
        $conversionRate = $totalBookings > 0 ? ($confirmedBookings / $totalBookings) * 100 : 0;
        $metrics[] = '# HELP tripx_bookings_conversion_rate Booking conversion rate (%)';
        $metrics[] = '# TYPE tripx_bookings_conversion_rate gauge';
        $metrics[] = sprintf('tripx_bookings_conversion_rate %.2f', $conversionRate);
        $metrics[] = '';
        
        // Average booking value
        $avgBookingValue = $confirmedBookings > 0 ? $revenue / $confirmedBookings : 0;
        $metrics[] = '# HELP tripx_business_avg_booking_value Average booking value (€)';
        $metrics[] = '# TYPE tripx_business_avg_booking_value gauge';
        $metrics[] = sprintf('tripx_business_avg_booking_value %.2f', $avgBookingValue);
        $metrics[] = '';
        
        // RevPAR (Revenue Per Available Room)
        $revpar = $totalRooms > 0 ? $revenueThisMonth / $totalRooms : 0;
        $metrics[] = '# HELP tripx_business_revpar Revenue Per Available Room (€)';
        $metrics[] = '# TYPE tripx_business_revpar gauge';
        $metrics[] = sprintf('tripx_business_revpar %.2f', $revpar);
        $metrics[] = '';
        
        // Occupancy rate
        $occupancyRate = $totalRooms > 0 ? ($availableRooms / $totalRooms) * 100 : 0;
        $metrics[] = '# HELP tripx_business_occupancy_rate Current occupancy rate (%)';
        $metrics[] = '# TYPE tripx_business_occupancy_rate gauge';
        $metrics[] = sprintf('tripx_business_occupancy_rate %.2f', $occupancyRate);
        $metrics[] = '';
        
        // ============================================
        // 5. STORAGE & IMAGE METRICS
        // ============================================
        $projectDir = $this->getParameter('kernel.project_dir');
        $uploadPaths = [
            'rooms' => $projectDir . '/public/uploads/images/rooms',
            'hotels' => $projectDir . '/public/uploads/images/hotels',
            'villas' => $projectDir . '/public/uploads/images/villas',
            'apartments' => $projectDir . '/public/uploads/images/apartments',
        ];
        
        foreach ($uploadPaths as $type => $path) {
            $exists = is_dir($path) ? 1 : 0;
            $metrics[] = sprintf('tripx_storage_upload_dir_exists{type="%s"} %d', $type, $exists);
            
            if ($exists) {
                $writable = is_writable($path) ? 1 : 0;
                $metrics[] = sprintf('tripx_storage_upload_dir_writable{type="%s"} %d', $type, $writable);
                
                $fileCount = count(glob($path . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE));
                $metrics[] = sprintf('tripx_storage_upload_dir_files{type="%s"} %d', $type, $fileCount);
            }
        }
        
        $mainPath = $projectDir . '/public/uploads';
        if (is_dir($mainPath)) {
            $freeSpace = disk_free_space($mainPath);
            $totalSpace = disk_total_space($mainPath);
            $usedSpace = $totalSpace - $freeSpace;
            
            $metrics[] = '# HELP tripx_storage_disk_total_bytes Total disk space in bytes';
            $metrics[] = '# TYPE tripx_storage_disk_total_bytes gauge';
            $metrics[] = sprintf('tripx_storage_disk_total_bytes %.0f', $totalSpace);
            $metrics[] = '';
            
            $metrics[] = '# HELP tripx_storage_disk_used_bytes Used disk space in bytes';
            $metrics[] = '# TYPE tripx_storage_disk_used_bytes gauge';
            $metrics[] = sprintf('tripx_storage_disk_used_bytes %.0f', $usedSpace);
            $metrics[] = '';
            
            $metrics[] = '# HELP tripx_storage_disk_free_bytes Free disk space in bytes';
            $metrics[] = '# TYPE tripx_storage_disk_free_bytes gauge';
            $metrics[] = sprintf('tripx_storage_disk_free_bytes %.0f', $freeSpace);
            $metrics[] = '';
            
            $metrics[] = '# HELP tripx_storage_disk_free_gb Free disk space in GB';
            $metrics[] = '# TYPE tripx_storage_disk_free_gb gauge';
            $metrics[] = sprintf('tripx_storage_disk_free_gb %.2f', $freeSpace / 1073741824);
            $metrics[] = '';
            
            $metrics[] = '# HELP tripx_storage_disk_usage_percent Disk usage percentage';
            $metrics[] = '# TYPE tripx_storage_disk_usage_percent gauge';
            $metrics[] = sprintf('tripx_storage_disk_usage_percent %.2f', ($usedSpace / $totalSpace) * 100);
            $metrics[] = '';
            
            $lowDiskWarning = $freeSpace < 1073741824 ? 1 : 0;
            $metrics[] = '# HELP tripx_storage_disk_low_warning Low disk space warning (<1GB)';
            $metrics[] = '# TYPE tripx_storage_disk_low_warning gauge';
            $metrics[] = sprintf('tripx_storage_disk_low_warning %d', $lowDiskWarning);
            $metrics[] = '';
        }
        
        $totalImages = $this->roomImagesRepo->count([]);
        $metrics[] = '# HELP tripx_storage_images_total Total uploaded room images';
        $metrics[] = '# TYPE tripx_storage_images_total gauge';
        $metrics[] = sprintf('tripx_storage_images_total %d', $totalImages);
        $metrics[] = '';
        
        $imagesPerRoom = $totalRooms > 0 ? $totalImages / $totalRooms : 0;
        $metrics[] = '# HELP tripx_business_images_per_room Average images per room';
        $metrics[] = '# TYPE tripx_business_images_per_room gauge';
        $metrics[] = sprintf('tripx_business_images_per_room %.2f', $imagesPerRoom);
        $metrics[] = '';
        
        // Orphaned images
        $orphanedImages = 0;
        foreach ($uploadPaths as $type => $path) {
            if (is_dir($path)) {
                $files = glob($path . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                foreach ($files as $file) {
                    $filename = basename($file);
                    $exists = $this->roomImagesRepo->findOneBy(['fileName' => $filename]);
                    if (!$exists) {
                        $orphanedImages++;
                    }
                }
            }
        }
        $metrics[] = '# HELP tripx_storage_orphaned_images Images without database records';
        $metrics[] = '# TYPE tripx_storage_orphaned_images gauge';
        $metrics[] = sprintf('tripx_storage_orphaned_images %d', $orphanedImages);
        $metrics[] = '';
        
        // ============================================
        // 6. NOTIFICATION METRICS
        // ============================================
        $unreadCount = $this->notificationRepo->findUnreadCount();
        $metrics[] = '# HELP tripx_notifications_unread Unread admin notifications';
        $metrics[] = '# TYPE tripx_notifications_unread gauge';
        $metrics[] = sprintf('tripx_notifications_unread %d', $unreadCount);
        $metrics[] = '';
        
        $highUnreadWarning = $unreadCount > 10 ? 1 : 0;
        $metrics[] = '# HELP tripx_notifications_high_unread_warning High unread notifications warning (>10)';
        $metrics[] = '# TYPE tripx_notifications_high_unread_warning gauge';
        $metrics[] = sprintf('tripx_notifications_high_unread_warning %d', $highUnreadWarning);
        $metrics[] = '';
        
        // ============================================
        // 7. SYSTEM PERFORMANCE METRICS
        // ============================================
        $memoryUsage = memory_get_usage(true);
        $memoryPeak = memory_get_peak_usage(true);
        $memoryLimit = $this->convertToBytes(ini_get('memory_limit'));
        
        $metrics[] = '# HELP tripx_system_php_memory_limit_bytes PHP memory limit in bytes';
        $metrics[] = '# TYPE tripx_system_php_memory_limit_bytes gauge';
        $metrics[] = sprintf('tripx_system_php_memory_limit_bytes %d', $memoryLimit);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_system_php_memory_usage_bytes Current PHP memory usage in bytes';
        $metrics[] = '# TYPE tripx_system_php_memory_usage_bytes gauge';
        $metrics[] = sprintf('tripx_system_php_memory_usage_bytes %d', $memoryUsage);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_system_php_memory_peak_bytes Peak PHP memory usage in bytes';
        $metrics[] = '# TYPE tripx_system_php_memory_peak_bytes gauge';
        $metrics[] = sprintf('tripx_system_php_memory_peak_bytes %d', $memoryPeak);
        $metrics[] = '';
        
        $memoryPercent = $memoryLimit > 0 ? ($memoryUsage / $memoryLimit) * 100 : 0;
        $metrics[] = '# HELP tripx_system_php_memory_usage_percent PHP memory usage percentage';
        $metrics[] = '# TYPE tripx_system_php_memory_usage_percent gauge';
        $metrics[] = sprintf('tripx_system_php_memory_usage_percent %.2f', $memoryPercent);
        $metrics[] = '';
        
        // PHP settings
        $maxExecutionTime = (int) ini_get('max_execution_time');
        $metrics[] = '# HELP tripx_system_php_max_execution_time PHP max execution time in seconds';
        $metrics[] = '# TYPE tripx_system_php_max_execution_time gauge';
        $metrics[] = sprintf('tripx_system_php_max_execution_time %d', $maxExecutionTime);
        $metrics[] = '';
        
        $uploadMaxSize = $this->convertToBytes(ini_get('upload_max_filesize'));
        $postMaxSize = $this->convertToBytes(ini_get('post_max_size'));
        
        $metrics[] = '# HELP tripx_system_php_upload_max_size_mb PHP upload max filesize in MB';
        $metrics[] = '# TYPE tripx_system_php_upload_max_size_mb gauge';
        $metrics[] = sprintf('tripx_system_php_upload_max_size_mb %.2f', $uploadMaxSize / 1048576);
        $metrics[] = '';
        
        $metrics[] = '# HELP tripx_system_php_post_max_size_mb PHP post max size in MB';
        $metrics[] = '# TYPE tripx_system_php_post_max_size_mb gauge';
        $metrics[] = sprintf('tripx_system_php_post_max_size_mb %.2f', $postMaxSize / 1048576);
        $metrics[] = '';
        
        // PHP extensions
        $extensions = ['gd', 'mysqli', 'json', 'curl', 'zip', 'mbstring', 'xml', 'openssl'];
        foreach ($extensions as $ext) {
            $loaded = extension_loaded($ext) ? 1 : 0;
            $metrics[] = sprintf('tripx_system_php_extension_loaded{extension="%s"} %d', $ext, $loaded);
        }
        $metrics[] = '';
        
        // ============================================
        // 8. BUSINESS INTELLIGENCE METRICS
        // ============================================
        $roomsPerAccommodation = $stats['total'] > 0 ? $totalRooms / $stats['total'] : 0;
        $metrics[] = '# HELP tripx_business_rooms_per_accommodation Average rooms per accommodation';
        $metrics[] = '# TYPE tripx_business_rooms_per_accommodation gauge';
        $metrics[] = sprintf('tripx_business_rooms_per_accommodation %.2f', $roomsPerAccommodation);
        $metrics[] = '';
        
        $revenuePerRoom = $totalRooms > 0 ? $revenueThisMonth / $totalRooms : 0;
        $metrics[] = '# HELP tripx_business_revenue_per_room Revenue per room (€)';
        $metrics[] = '# TYPE tripx_business_revenue_per_room gauge';
        $metrics[] = sprintf('tripx_business_revenue_per_room %.2f', $revenuePerRoom);
        $metrics[] = '';
        
        // ============================================
        // 9. SECURITY METRICS
        // ============================================
        $httpsEnabled = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 1 : 0;
        $metrics[] = '# HELP tripx_security_https_enabled HTTPS is enabled (1=yes, 0=no)';
        $metrics[] = '# TYPE tripx_security_https_enabled gauge';
        $metrics[] = sprintf('tripx_security_https_enabled %d', $httpsEnabled);
        $metrics[] = '';
        
        $debugEnabled = $_ENV['APP_DEBUG'] ?? false;
        $metrics[] = '# HELP tripx_security_debug_mode Debug mode is enabled (1=yes, 0=no - production)';
        $metrics[] = '# TYPE tripx_security_debug_mode gauge';
        $metrics[] = sprintf('tripx_security_debug_mode %d', $debugEnabled ? 1 : 0);
        $metrics[] = '';
        
        $environment = $_ENV['APP_ENV'] ?? 'dev';
        $metrics[] = '# HELP tripx_security_environment Application environment';
        $metrics[] = '# TYPE tripx_security_environment gauge';
        $metrics[] = sprintf('tripx_security_environment{env="%s"} 1', $environment);
        $metrics[] = '';
        
        // ============================================
        // 10. MAILER METRICS (Placeholder - add real data if available)
        // ============================================
        $mailerSuccessRate = 100.0; // Replace with actual mailer metrics
        $metrics[] = '# HELP tripx_mailer_success_rate Email success rate (%)';
        $metrics[] = '# TYPE tripx_mailer_success_rate gauge';
        $metrics[] = sprintf('tripx_mailer_success_rate %.2f', $mailerSuccessRate);
        $metrics[] = '';
        
        // ============================================
        // 11. GOOGLE CALENDAR METRICS (Placeholder)
        // ============================================
        $googleCalendarHealthy = 0; // Replace with actual Google Calendar check
        $metrics[] = '# HELP tripx_google_calendar_healthy Google Calendar API is healthy (1=yes, 0=no)';
        $metrics[] = '# TYPE tripx_google_calendar_healthy gauge';
        $metrics[] = sprintf('tripx_google_calendar_healthy %d', $googleCalendarHealthy);
        $metrics[] = '';
        
        // ============================================
        // 12. APPLICATION PERFORMANCE
        // ============================================
        $startTime = defined('START_TIME') ? START_TIME : $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true);
        $responseTime = (microtime(true) - $startTime) * 1000;
        $metrics[] = '# HELP tripx_app_response_time_ms Application response time in milliseconds';
        $metrics[] = '# TYPE tripx_app_response_time_ms gauge';
        $metrics[] = sprintf('tripx_app_response_time_ms %.2f', $responseTime);
        $metrics[] = '';
        
        // Return as plain text
        return new Response(implode("\n", $metrics), 200, ['Content-Type' => 'text/plain; version=0.0.4']);
    }

    private function convertToBytes(string $value): int
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);
        $bytes = (int) $value;
        
        switch ($last) {
            case 'g':
                $bytes *= 1024;
            case 'm':
                $bytes *= 1024;
            case 'k':
                $bytes *= 1024;
        }
        
        return $bytes;
    }
}