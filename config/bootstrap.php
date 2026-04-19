<?php

use Symfony\Component\Dotenv\Dotenv;

// Ensure .env is loaded for both CLI and web runtime.
if (!isset($_SERVER['APP_ENV']) && !isset($_ENV['APP_ENV'])) {
    $_SERVER['APP_ENV'] = 'dev';
}

if (class_exists(Dotenv::class)) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

