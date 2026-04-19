<?php
require 'vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(__DIR__.'/.env');

$kernel = new App\Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

$container = $kernel->getContainer();
$twig = $container->get('twig');
$chartBuilder = $container->get(Symfony\UX\Chartjs\Builder\ChartBuilderInterface::class);
$chart = $chartBuilder->createChart(Symfony\UX\Chartjs\Model\Chart::TYPE_BAR);
$chart->setData(['labels' => ['A'], 'datasets' => [['data' => [1]]]]);
echo $twig->render('debug_chart.html.twig', ['chart' => $chart]);
