<?php

namespace App\service\Accommodation;

use Symfony\Component\Filesystem\Filesystem;

class CacheService
{
    private string $cacheDir;
    private Filesystem $filesystem;

    public function __construct(string $projectDir)
    {
        $this->cacheDir = $projectDir . '/var/cache/api/';
        $this->filesystem = new Filesystem();
        
        if (!$this->filesystem->exists($this->cacheDir)) {
            $this->filesystem->mkdir($this->cacheDir);
        }
    }

    public function get(string $key): ?array
    {
        $filePath = $this->cacheDir . md5($key) . '.json';
        
        if (!$this->filesystem->exists($filePath)) {
            return null;
        }
        
        $content = file_get_contents($filePath);
        $data = json_decode($content, true);
        
        if ($data && isset($data['expires_at']) && $data['expires_at'] > time()) {
            return $data['value'];
        }
        
        $this->delete($key);
        return null;
    }

    public function set(string $key, $value, int $ttl = 3600): void
    {
        $filePath = $this->cacheDir . md5($key) . '.json';
        
        $data = [
            'value' => $value,
            'expires_at' => time() + $ttl,
            'created_at' => time()
        ];
        
        $this->filesystem->dumpFile($filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function has(string $key): bool
    {
        return $this->get($key) !== null;
    }

    public function delete(string $key): void
    {
        $filePath = $this->cacheDir . md5($key) . '.json';
        if ($this->filesystem->exists($filePath)) {
            $this->filesystem->remove($filePath);
        }
    }

    public function clear(): void
    {
        $this->filesystem->remove($this->cacheDir);
        $this->filesystem->mkdir($this->cacheDir);
    }
}