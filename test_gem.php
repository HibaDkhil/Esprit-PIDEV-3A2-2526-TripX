<?php
$key = 'AIzaSyBWh84M8wdi8XiGZEpIsFMgQ5hvTkj-rvs';
$url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=' . $key;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'contents' => [['parts' => [['text' => 'Generate a short, inspiring 3-day personalized trip itinerary for Barcelona using valid HTML.']]]],
    'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 400]
]));

$res = curl_exec($ch);
echo $res;
