<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/cssConfig.php';

use Akmalmp\GudangSortir\App\Router;
use Akmalmp\GudangSortir\Controller\DashboardController;
use Akmalmp\GudangSortir\Controller\HomeController;
use Akmalmp\GudangSortir\Controller\UserController;

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// Dashboard Controller
Router::add('GET', '/dashboard', DashboardController::class, 'dashboard', []);

// User Controller
Router::add('GET', '/users/login', UserController::class, 'login', []);
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);

Router::run();