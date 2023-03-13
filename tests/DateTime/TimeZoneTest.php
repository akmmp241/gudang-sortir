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

    /**
     * @throws \Exception
     */
    public function testCreateDate()
    {
        $date = "03/07/2023";
        $time = new DateTime();
        $time = $time->getTimestamp();
        $tanggal = new DateTime($date);

        print_r($tanggal);
        echo $tanggal->format("Y-m-d H:i:s");

        assertNotNull($tanggal);
    }


}