<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route (after successful login)
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Users
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');

// News
Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news');

// Portfolio
Route::get('/admin/portfolio', [UserController::class, 'index'])->name('admin.portfolio');

// Startups
Route::get('/admin/startups', [UserController::class, 'index'])->name('admin.startups');

// Venture Capitals
Route::get('/admin/venture', [UserController::class, 'index'])->name('admin.venture');


// Verify Email
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);
