<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/cssConfig.php';

use Akmalmp\GudangSortir\App\Router;
use Akmalmp\GudangSortir\Controller\BarangController;
use Akmalmp\GudangSortir\Controller\DashboardController;
use Akmalmp\GudangSortir\Controller\HomeController;
use Akmalmp\GudangSortir\Controller\KategoriController;
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
Router::add('GET', '/dashboard/kategori', KategoriController::class, 'kategori', [MustLoginMiddleware::class]);
Router::add('POST', '/dashboard/kategori', KategoriController::class, 'postKategori', [MustLoginMiddleware::class]);
Router::add('GET', '/dashboard/kategori/hapus/([0-9A-Za-z]*)', KategoriController::class, 'hapusKategori', [MustLoginMiddleware::class]);
//      Barang
Router::add('GET', '/dashboard/barang', BarangController::class, 'barang', [MustLoginMiddleware::class]);
Router::add('POST', '/dashboard/barang', BarangController::class, 'postBarang', [MustLoginMiddleware::class]);
Router::add('GET', '/dashboard/barang/hapus/([0-9A-Za-z-]*)', BarangController::class, 'hapusBarang', [MustLoginMiddleware::class]);

// User Controller
//      Login page
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
//      Register page
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
//      Profile
Router::add('GET', '/users/profile', UserController::class, 'profile', [MustLoginMiddleware::class]);
//      Update Password
Router::add('GET', '/users/profile/update-password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile/update-password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);
//      Update Email
Router::add('GET', '/users/profile/update-email', UserController::class, 'updateEmail', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile/update-email', UserController::class, 'postUpdateEmail', [MustLoginMiddleware::class]);
//      Update Nama
Router::add('GET', '/users/profile/update-nama', UserController::class, 'updateNama', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile/update-nama', UserController::class, 'postUpdateNama', [MustLoginMiddleware::class]);
//      Logout
Router::add('GET', '/users/logout', UserController::class, 'logout', [LogoutMiddleware::class]);

Router::run();