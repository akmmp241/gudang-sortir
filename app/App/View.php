<?php

namespace Akmalmp\GudangSortir\App;

class View
{
    public static function render(string $url, $model)
    {
        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $url . '.php';
        require __DIR__ . '/../View/footer.php';
    }

    public static function redirect(string $url): void
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }
}