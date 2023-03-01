<?php

namespace Akmalmp\GudangSortir\Sort;

use PHPUnit\Framework\TestCase;

class SortingTest extends TestCase
{
    public function testSorting()
    {
        $barang1 = "00001";
        $barang2 = "00002";
        $barang3 = "00004";
        $barang4 = "00003";

        $barang = [
            $barang1, $barang2, $barang3, $barang4
        ];

        $sort = sort($barang, SORT_NATURAL);
        echo $sort;
        foreach ($barang as $item) {
            echo $item . PHP_EOL;
        }

        self::assertNotNull($sort);
    }

}