<?php

namespace Akmalmp\GudangSortir\ParseUrl;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class TestParseUrl extends TestCase
{
    public function testParseUrl()
    {
        $url = "http://gudang-test.com/dashboard/barang/ubah-barang/TRPD-00003";
        $urlParse = parse_url($url, PHP_URL_PATH);
        $path = explode("/", $urlParse);

        var_dump(parse_url($url, PHP_URL_PATH));
        var_dump($urlParse);
        var_dump($path);
        self::assertNotNull($url);
    }

    public function testParseUrlAnother()
    {
        $url = "http://gudang-test.com/dashboard/transaksi/barang-keluar";
        $parseURL = explode('-', explode('/', parse_url($url, PHP_URL_PATH))[3])[1];

        var_dump($parseURL);
        assertNotNull($parseURL);
    }


}
