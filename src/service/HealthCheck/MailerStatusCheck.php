<?php

namespace App\service\HealthCheck;

use Laminas\Diagnostics\Check\CheckInterface;
use Laminas\Diagnostics\Result\ResultInterface;
use Laminas\Diagnostics\Result\Success;
use Laminas\Diagnostics\Result\Failure;
use Symfony\Component\Mailer\Transport\TransportInterface;

class MailerStatusCheck implements CheckInterface
{
    private TransportInterface $transport;

    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function check(): ResultInterface
    {
        try {
            // For many transports, __toString() shows the DSN which we can verify exists
            $dsn = (string)$this->transport;
            
            if (empty($dsn)) {
                return new Failure('Mailer transport is not properly configured.');
            }

            return new Success('Mailer transport is initialized (' . $this->getTransportType() . ').');
        } catch (\Exception $e) {
            return new Failure('Mailer health check failed: ' . $e->getMessage());
        }
    }

    private function getTransportType(): string
    {
        $class = get_class($this->transport);
        $parts = explode('\\', $class);
        return end($parts);
    }

    public function getLabel(): string
    {
        return 'Symfony Mailer Check';
    }
}
