<?php

namespace Akmalmp\GudangSortir\TimeZone;

use DateTime;
use PHPUnit\Framework\TestCase;

class TimeZoneTest extends TestCase
{
    public function testTimeZone()
    {
        $date = new DateTime();
        $tanggal = $date->format("Y-m-j");
        var_dump($date);
        self::assertNotNull($date);
        var_dump($tanggal);
    }

}