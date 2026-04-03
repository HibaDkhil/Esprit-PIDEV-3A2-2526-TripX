<?php
// Custom asset proxy to fix broken local PHP/Symfony environments serving CSS as HTML
$file = $_GET['f'] ?? '';

// Basic security check
if (empty($file) || strpos($file, '..') !== false) {
    http_response_code(403);
    exit;
}

$path = __DIR__ . '/' . $file;
if (file_exists($path) && is_file($path)) {
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if ($ext === 'css') {
        header('Content-Type: text/css; charset=UTF-8');
    } elseif ($ext === 'js') {
        header('Content-Type: application/javascript; charset=UTF-8');
    } else {
        http_response_code(403);
        exit;
    }
    
    // Disable caching for dev
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    readfile($path);
    exit;
}

http_response_code(404);
echo "Asset not found.";
