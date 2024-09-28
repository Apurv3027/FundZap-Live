<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminStartupController;
use App\Http\Controllers\Admin\AdminVentureCapitalController;

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
Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

// Users
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');

// News
Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news');

// Portfolio
Route::get('/admin/portfolio', [AdminPortfolioController::class, 'index'])->name('admin.portfolio');

// Startups
Route::get('/admin/startups', [AdminStartupController::class, 'index'])->name('admin.startups');

// Venture Capitals
Route::get('/admin/venture', [AdminVentureCapitalController::class, 'index'])->name('admin.venture');


// Verify Email
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);
