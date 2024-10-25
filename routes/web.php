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
use App\Http\Controllers\Admin\AdminCompetitorController;
use App\Http\Controllers\Admin\AdminValuationController;
use App\Http\Controllers\Admin\AdminFundingRoundController;
use App\Http\Controllers\Admin\AdminInvestmentController;
use App\Http\Controllers\Admin\AdminSectorController;
use App\Http\Controllers\Admin\AdminCountryController;
use App\Http\Controllers\Admin\AdminOrderController;

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
Route::get('/admin/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
Route::post('/admin/users/{id}/verify-documents', [AdminUserController::class, 'verifyDocuments']);
Route::delete('/admin/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

// News
Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news');
Route::get('/admin/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
Route::post('/admin/news/store', [AdminNewsController::class, 'store'])->name('admin.news.store');
Route::get('/admin/news/{id}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
Route::put('/admin/news/{id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
Route::get('/admin/news/{id}', [AdminNewsController::class, 'show'])->name('admin.news.show');
Route::delete('/admin/news/{id}/delete', [AdminNewsController::class, 'deleteNews'])->name('admin.news.delete');

// Portfolio
// Route::get('/admin/portfolio', [AdminPortfolioController::class, 'index'])->name('admin.portfolio');
// Route::get('/admin/portfolio/create', [AdminPortfolioController::class, 'create'])->name('admin.portfolio.create');
// Route::post('/admin/portfolio/store', [AdminPortfolioController::class, 'store'])->name('admin.portfolio.store');
// Route::get('/admin/portfolio/{id}/edit', [AdminPortfolioController::class, 'edit'])->name('admin.portfolio.edit');
// Route::put('/admin/portfolio/{id}', [AdminPortfolioController::class, 'update'])->name('admin.portfolio.update');
// Route::get('/admin/portfolio/{id}', [AdminPortfolioController::class, 'show'])->name('admin.portfolio.show');

// Startups
Route::get('/admin/startups', [AdminStartupController::class, 'index'])->name('admin.startups');
Route::get('/admin/startups/create', [AdminStartupController::class, 'create'])->name('admin.startups.create');
Route::post('/admin/startups/store', [AdminStartupController::class, 'store'])->name('admin.startups.store');
Route::get('/admin/startups/{id}/edit', [AdminStartupController::class, 'edit'])->name('admin.startups.edit');
Route::put('/admin/startups/{id}', [AdminStartupController::class, 'update'])->name('admin.startups.update');
Route::get('/admin/startups/{id}', [AdminStartupController::class, 'show'])->name('admin.startups.show');

// Startups/Valuations
Route::get('/admin/startups/{startup_id}/valuations/create', [AdminValuationController::class, 'create'])->name('admin.startups.valuations.create');
Route::post('/admin/startups/{startup_id}/valuations/store', [AdminValuationController::class, 'store'])->name('admin.startups.valuations.store');

// Startups/Funding Rounds
Route::get('/admin/startups/{startup_id}/funding-rounds/create', [AdminFundingRoundController::class, 'create'])->name('admin.startups.funding_rounds.create');
Route::post('/admin/startups/{startup_id}/funding-rounds/store', [AdminFundingRoundController::class, 'store'])->name('admin.startups.funding_rounds.store');

// Startups/Competitors
Route::get('/admin/startups/{startup_id}/competitors/create', [AdminCompetitorController::class, 'create'])->name('admin.startups.competitors.create');
Route::post('/admin/startups/{startup_id}/competitors/store', [AdminCompetitorController::class, 'store'])->name('admin.startups.competitors.store');

// Venture Capitals
Route::get('/admin/venture', [AdminVentureCapitalController::class, 'index'])->name('admin.venture');
Route::get('/admin/venture/create', [AdminVentureCapitalController::class, 'create'])->name('admin.venture.create');
Route::post('/admin/venture/store', [AdminVentureCapitalController::class, 'store'])->name('admin.venture.store');
Route::get('/admin/venture/{id}/edit', [AdminVentureCapitalController::class, 'edit'])->name('admin.venture.edit');
Route::put('/admin/venture/{id}', [AdminVentureCapitalController::class, 'update'])->name('admin.venture.update');
Route::get('/admin/venture/{id}', [AdminVentureCapitalController::class, 'show'])->name('admin.venture.show');

// Venture Capitals/Investments
Route::get('/admin/venture/{venture_capital_id}/investments/create', [AdminInvestmentController::class, 'create'])->name('admin.venture.investments.create');
Route::post('/admin/venture/{venture_capital_id}/investments/store', [AdminInvestmentController::class, 'store'])->name('admin.venture.investments.store');

// Venture Capitals/Sectors
Route::get('/admin/venture/{venture_capital_id}/sectors/create', [AdminSectorController::class, 'create'])->name('admin.venture.sectors.create');
Route::post('/admin/venture/{venture_capital_id}/sectors/store', [AdminSectorController::class, 'store'])->name('admin.venture.sectors.store');

// Venture Capitals/Country
Route::get('/admin/venture/{venture_capital_id}/countries/create', [AdminCountryController::class, 'create'])->name('admin.venture.countries.create');
Route::post('/admin/venture/{venture_capital_id}/countries/store', [AdminCountryController::class, 'store'])->name('admin.venture.countries.store');

// Venture Capitals/Portfolios
Route::get('/admin/venture/{venture_capital_id}/portfolios/create', [AdminPortfolioController::class, 'create'])->name('admin.venture.portfolios.create');
Route::post('/admin/venture/{venture_capital_id}/portfolios/store', [AdminPortfolioController::class, 'store'])->name('admin.venture.portfolios.store');

// Verify Email
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);

// Users
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/{user_id}/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::post('/admin/orders/verify-payment-status/{userId}/{orderId}', [AdminOrderController::class, 'verifyPaymentStatus'])->name('orders.verify-payment-status');
