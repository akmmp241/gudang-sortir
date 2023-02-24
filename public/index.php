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
//      Login page
Router::add('GET', '/users/login', UserController::class, 'login', []);
Router::add('POST', '/users/login', UserController::class, 'postLogin', []);
//      Register page
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);
//      Logout
Router::add('GET', '/users/logout', UserController::class, 'logout', []);

Router::run();