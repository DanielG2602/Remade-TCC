<?php

declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function connection(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::createConnection();
        }

        return self::$instance;
    }

    private static function createConnection(): PDO
    {
        $host     = $_ENV['DB_HOST']     ?? 'mysql';
        $port     = $_ENV['DB_PORT']     ?? '3306';
        $name     = $_ENV['DB_NAME']     ?? 'acervo_rct';
        $user     = $_ENV['DB_USER']     ?? '';
        $password = $_ENV['DB_PASSWORD'] ?? '';

        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

            return $pdo;
        } catch (PDOException $e) {
            throw new RuntimeException('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
    }
}