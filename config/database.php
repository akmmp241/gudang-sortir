<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=gudang_sortir_test",
                "user" => "akmmp",
                "password" => "root"
            ],
            "production" =>[
                "url" => "mysql:host=localhost:3306;dbname=gudang_sortir",
                "user" => "akmmp",
                "password" => "root"
            ]
        ]
    ];
}