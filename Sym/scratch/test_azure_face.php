<?php
// Put your Google Vision API key here
$apiKey = 'AIzaSyBQt1A4eFrczPXvomHl2EPhB1PTxEGf3Io';  // ← PASTE YOUR GOOGLE VISION API KEY

echo "Testing Google Vision API...\n";
echo "API Key Length: " . strlen($apiKey) . "\n";

// Small test image (1x1 pixel PNG)
$testImage = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');

$payload = [
    'requests' => [
        [
            'image' => [
                'content' => base64_encode($testImage)
            ],
            'features' => [
                [
                    'type' => 'FACE_DETECTION',
                    'maxResults' => 5
                ]
            ]
        ]
    ]
];

$ch = curl_init('https://vision.googleapis.com/v1/images:annotate?key=' . $apiKey);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";

if ($httpCode === 200) {
    echo "\n✅ Google Vision API is WORKING!\n";
} else {
    echo "\n❌ Google Vision API error. Check your API key.\n";
}