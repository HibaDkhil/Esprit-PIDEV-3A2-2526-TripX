<?php

// standalone test for Gemini API key
$apiKey = 'AIzaSyC42GawqpjQd7Dq6m6h2RTW_FPMGleaTrc';
$model = 'gemini-2.5-flash';
$url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => 'Hello Gemini, this is a test from TripX assistant. please reply with a short "System Online" message if you can read this.']
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status Code: $httpCode\n";
echo "Response body:\n$response\n";
