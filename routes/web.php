<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

//      Home Page
Route::get('/', [HomeController::class, 'home'])->middleware('must.not.login');

//      Dashboard Page
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('must.login');

//      User Page
// Login Page
Route::get('/users/login', [UserController::class, 'login'])->middleware(['must.not.login']);
Route::post('/users/login', [UserController::class, 'postLogin'])->middleware(['must.not.login']);
// Register Page
Route::get('/users/register', [UserController::class, 'register'])->middleware(['must.not.login']);
Route::post('/users/register', [UserController::class, 'postRegister'])->middleware(['must.not.login']);
// Profile & Update Profile Page
Route::get('/users/profile', [UserController::class, 'profile'])->middleware('must.login');
Route::post('users/profile', [UserController::class, 'postUpdateProfile'])->middleware('must.login');
// Change Password Page
Route::get('/users/update-password', [UserController::class, 'updatePassword'])->middleware('must.login');
Route::post('/users/update-password', [UserController::class, 'postUpdatePassword'])->middleware('must.login');
// Logout
Route::get('/users/logout', [UserController::class, 'logout'])->middleware('must.login');

//      Category Page
// Add Category Page
Route::get('/dashboard/category', [CategoryController::class, 'category'])->middleware(['must.login']);
Route::post('/dashboard/category', [CategoryController::class, 'postCategory'])->middleware('must.login');
// Edit Category Page
Route::get('/dashboard/category/update-category/{categoryId}', [CategoryController::class, 'updateCategory'])
    ->where('categoryId', '([0-9A-Za-z]*)')
    ->middleware(['must.login', 'category']);
Route::post('/dashboard/category/update-category/{categoryId}', [CategoryController::class, 'postUpdateCategory'])
    ->where('categoryId', '([0-9A-Za-z]*)')
    ->middleware(['must.login', 'category']);
// Delete Category
Route::get('/dashboard/category/delete/{categoryId}', [CategoryController::class, 'deleteCategory'])
    ->where('categoryId', '([0-9A-Za-z]*)')
    ->middleware(['must.login', 'category']);

Route::get('/welcome', function () {
    return view('welcome');
});
