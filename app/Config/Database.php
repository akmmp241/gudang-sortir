<?php

namespace Akmalmp\GudangSortir\Config;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(string $env = "test"): PDO
    {
        if (self::$pdo == null) {
            require_once __DIR__ . '/../../config/database.php';
            $config = getDatabaseConfig();
            self::$pdo = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['user'],
                $config['database'][$env]['password']
            );

            return self::$pdo;
        }
    }

    public function beginTransaction(): void
    {
        self::$pdo->beginTransaction();
    }

    public function commitTransaction(): void
    {
        self::$pdo->commit();
    }

    public function rollbackTransaction(): void
    {
        self::$pdo->rollBack();
    }
}