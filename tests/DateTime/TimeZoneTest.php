<?php

namespace Akmalmp\GudangSortir\DateTime;

use DateTime;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

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

    public function testDate()
    {
        $tanggalNow = new DateTime();

        self::assertNotNull($tanggalNow);

        echo $tanggalNow->format('m/d/Y');
    }

    public function testCreateDate()
    {
        $date = "03/07/2023";

        $tanggal = date_create($date);

        print_r($tanggal);
        echo $tanggal->format('Y-m-d');

        assertNotNull($tanggal);
    }


}