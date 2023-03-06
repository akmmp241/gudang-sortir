<?php

namespace Akmalmp\GudangSortir\ParseUrl;

use PHPUnit\Framework\TestCase;

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

}
