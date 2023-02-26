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

    public function testFilterEmail()
    {
//        $pattern = "#^[a-zA-Z0-9.-]+@[a-zA-Z.]+$#";
        $pattern = "/^[_a-z0-9-]{6,30}+(\.[_a-z0-9-]{6,30}+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $email1 = "asde@gmail.com";
        $email2 = "<akmal>@gmail.com";
        $email3 = "\"akm\"@gmail.com";
        $email4 = "akmal-no@gmail.com";
        $email5 = "akmal@gmail.com5";
        $email6 = "akmal@gmail.com>\"";
        $email7 = "ak.mal@gmail.com";
        $result1 = preg_match($pattern, $email1, $variables1);
        $result2 = preg_match($pattern, $email2, $variables2);
        $result3 = preg_match($pattern, $email3, $variables3);
        $result4 = preg_match($pattern, $email4, $variables4);
        $result5 = preg_match($pattern, $email5, $variables5);
        $result6 = preg_match($pattern, $email6, $variables6);
        $result7 = preg_match($pattern, $email7, $variables7);
        var_dump("result1: " . $result1);
        var_dump("result2: " . $result2);
        var_dump("result3: " . $result3);
        var_dump("result4: " . $result4);
        var_dump("result5: " . $result5);
        var_dump("result6: " . $result6);
        var_dump("result7: " . $result7);
        var_dump($variables1);
        var_dump($variables2);
        var_dump($variables3);
        var_dump($variables4);
        var_dump($variables5);
        var_dump($variables6);
        var_dump($variables7);
        self::assertNotNull($result1);
    }


}