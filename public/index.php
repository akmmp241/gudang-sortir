<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/cssConfig.php';

use Akmalmp\GudangSortir\App\Router;
use Akmalmp\GudangSortir\Controller\DashboardController;
use Akmalmp\GudangSortir\Controller\HomeController;
use Akmalmp\GudangSortir\Controller\UserController;
use Akmalmp\GudangSortir\Middleware\LogoutMiddleware;
use Akmalmp\GudangSortir\Middleware\MustLoginMiddleware;
use Akmalmp\GudangSortir\Middleware\MustNotLoginMiddleware;

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', [MustNotLoginMiddleware::class]);

// Dashboard Controller
//      Dashboard
Router::add('GET', '/dashboard', DashboardController::class, 'dashboard', [MustLoginMiddleware::class]);
//      Kategori
Router::add('GET', '/dashboard/kategori', DashboardController::class, 'kategori', [MustLoginMiddleware::class]);
Router::add('POST', '/dashboard/kategori', DashboardController::class, 'postKategori', [MustLoginMiddleware::class]);

// User Controller
//      Login page
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
//      Register page
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
//      Logout
Router::add('GET', '/users/logout', UserController::class, 'logout', [LogoutMiddleware::class]);

Router::run();