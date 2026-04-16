<?php
// Scratch script to test speakTransportDetails directly
require 'vendor/autoload.php';

use App\Entity\Transport;
use App\Entity\Schedule;
use App\service\AccessibilitySpeechService;
use Symfony\Component\HttpClient\HttpClient;

// Mock dependencies
$client = HttpClient::create();
$apiKey = 'a1c3fc716a12553045bf7d29895720e1a5008b29bfa195af1345103a6d94ec74';

$service = new AccessibilitySpeechService($client, $apiKey);

$t = new Transport();
$t->setProviderName("Test Air");
$t->setVehicleModel("Boeing 747");
$t->setBasePrice(500.0);
$t->setTransportType("FLIGHT");

$s = new Schedule();
$s->setPriceMultiplier(1.2);

try {
    $result = $service->speakTransportDetails($t, $s);
    if (strpos($result, 'data:audio/mpeg;base64,') === 0) {
        echo "SUCCESS: Received base64 audio.\n";
    } else {
        echo "FALLBACK: Received: " . $result . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
