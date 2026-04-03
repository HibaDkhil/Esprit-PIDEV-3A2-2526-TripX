<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestDbController extends AbstractController
{
    #[Route('/test-db', name: 'test_db')]
    public function testDatabase(Connection $connection): JsonResponse
    {
        try {
            // Get database name
            $database = $connection->fetchOne('SELECT DATABASE()');
            
            // Get user count
            $userCount = $connection->fetchOne('SELECT COUNT(*) FROM user');
            
            // Get table count
            $tableCount = $connection->fetchOne("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'tripx_db'");
            
            // Get tables list
            $tables = $connection->fetchAllAssociative("SELECT table_name FROM information_schema.tables WHERE table_schema = 'tripx_db' ORDER BY table_name");
            
            return $this->json([
                'status' => 'connected',
                'database' => $database,
                'user_count' => (int)$userCount,
                'table_count' => (int)$tableCount,
                'tables' => array_column($tables, 'table_name'),
                'config' => [
                    'host' => '127.0.0.1',
                    'dbname' => 'tripx_db',
                    'user' => 'root'
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}