<?php

namespace Akmalmp\GudangSortir\App;

class View
{
    public static function render(string $path, $model): void
    {
        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $path . '.php';
        require __DIR__ . '/../View/footer.php';
    }

    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}