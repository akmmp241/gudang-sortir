<?php

use Akmalmp\GudangSortir\App\Router;
use Akmalmp\GudangSortir\Controller\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

Router::add('GET', '/', HomeController::class, 'index', []);

Router::run();