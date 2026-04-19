<?php
use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/tripcgitsym/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/tripcgitsym/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();
$weatherService = $container->get(\App\service\WeatherService::class);
$weather = $weatherService->getWeather(48.8566, 2.3522);
var_dump($weather);
