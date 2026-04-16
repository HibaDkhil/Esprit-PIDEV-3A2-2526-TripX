<?php

namespace App\service\HealthCheck;

use Laminas\Diagnostics\Check\CheckInterface;
use Laminas\Diagnostics\Result\ResultInterface;
use Laminas\Diagnostics\Result\Success;
use Laminas\Diagnostics\Result\Failure;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RedisStatusCheck implements CheckInterface
{
    private string $redisUrl;

    public function __construct(string $redisUrl)
    {
        $this->redisUrl = $redisUrl;
    }

    public function check(): ResultInterface
    {
        try {
            $url = parse_url($this->redisUrl);
            $host = $url['host'] ?? '127.0.0.1';
            $port = $url['port'] ?? 6379;

            $socket = @fsockopen($host, $port, $errno, $errstr, 2);
            if (!$socket) {
                return new Failure("Unable to connect to Redis at {$host}:{$port} ($errstr)");
            }
            fclose($socket);

            return new Success("Successfully reached Redis server at {$host}:{$port}.");
        } catch (\Exception $e) {
            return new Failure("Redis health check failed: " . $e->getMessage());
        }
    }

    public function getLabel(): string
    {
        return 'System Redis Check';
    }
}
