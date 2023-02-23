<?php

namespace Akmalmp\GudangSortir\App {
    function header(string $value): void
    {
        echo $value;
    }
}

namespace Akmalmp\GudangSortir\Service {
    function setcookie(string $name, string $value): void
    {
        echo "$name: $value";
    }
}