<?php

namespace Akmalmp\GudangSortir\Regex;

class RegexTest extends \PHPUnit\Framework\TestCase
{
    public function testRegexName()
    {
        $pattern = "/^[A-z]+$/";
        $input = "1%$^jndjsan/>.,:";
        $result = preg_match($pattern, $input);
        var_dump($result);
        self::assertNotTrue($result);
        $input = "jndjsan";
        $result = preg_match($pattern, $input);
        var_dump($result);
        self::assertEquals(1, $result);
    }

}