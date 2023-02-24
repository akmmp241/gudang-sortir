<?php

namespace Akmalmp\GudangSortir\Regex;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testRegexName()
    {
        $pattern = "/^[A-z\s]+$/";
        $input1 = "akmal&> joko@/";
        $input2 = "akmal joko";
        $result1 = preg_match($pattern, str_replace(' ', '', $input1));
        $result2 = preg_match($pattern, str_replace(' ', '', $input2));
        self::assertEquals(0, $result1);
        self::assertEquals(1, $result2);
        var_dump($input1);
        var_dump($input2);
    }

}