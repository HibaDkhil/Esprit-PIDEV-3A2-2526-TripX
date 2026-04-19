<?php
require 'vendor/autoload.php';
use Symfony\UX\StimulusBundle\Helper\StimulusHelper;
use Symfony\Component\AssetMapper\AssetMapperInterface;

$stimulus = new StimulusHelper(null);
$stimulusAttributes = $stimulus->createStimulusAttributes();
$stimulusAttributes->addController('@symfony/ux-chartjs/chart', ['view' => ['type' => 'bar']]);
echo (string) $stimulusAttributes;
