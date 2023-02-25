<?php

namespace Akmalmp\GudangSortir\Array;

use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function testArray()
    {
        $array = [];
        for ($i = 1; $i <= 5; $i++) {
            $array = [
                'nama_kategori' => [
                    'id' => $i,
                    'deskripsi' => ''
                ]
            ];
        }

        var_dump($array);
        self::assertNotNull($array);
    }

}