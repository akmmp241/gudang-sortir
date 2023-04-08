<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashbaord', [DashboardController::class, 'dashboard']);

Route::get('/users/login', [UserController::class, 'login'])
    ->middleware(['must.not.login']);
Route::get('/users/register', [UserController::class, 'login'])
    ->middleware(['must.not.login']);

Route::get('/welcome', function () {
    return view('welcome');
});
