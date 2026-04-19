<?php
use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/tripcgitsym/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/tripcgitsym/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();

$activityService = $container->get(\App\service\ActivityService::class);
$activities = $activityService->getAll();

$data = [];
foreach ($activities as $act) {
    try {
        $dest = $act->getDestination();
        if (!$dest || !$dest->getLatitude() || !$dest->getLongitude()) {
            continue;
        }
        $data[] = [
            'id'           => $act->getActivityId(),
            'name'         => $act->getName(),
            'category'     => $act->getCategory(),
            'price'        => $act->getPrice(),
            'duration'     => $act->getDurationMinutes(),
            'destination'  => $dest->getName(),
            'country'      => $dest->getCountry(),
            'lat'          => (float) $dest->getLatitude(),
            'lng'          => (float) $dest->getLongitude(),
        ];
    } catch (\Throwable $e) {
        echo "Error on activity " . $act->getActivityId() . ": " . $e->getMessage() . "\n";
    }
}
echo "Number of activities mapped: " . count($data) . "\n";
