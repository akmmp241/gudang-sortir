<?php

namespace Akmalmp\GudangSortir\Config;

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testConnection()
    {
        $connection = Database::getConnection();
        self::assertNotNull($connection);
    }

    public function testConnectionSingleton()
    {
        $connection1 = Database::getConnection();
        var_dump($connection1);
        self::assertNotNull($connection1);
    }


}
