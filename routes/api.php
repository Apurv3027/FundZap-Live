<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\ForgotPasswordController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\VentureCapitalController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserDocumentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Upload User Image
Route::post('/upload-user-image', [AuthController::class, 'uploadImage']);

// Register User
Route::post('/register', [AuthController::class, 'registerUser']);

// Upload User Documents
Route::post('/upload-user-documents', [UserDocumentsController::class, 'uploadDocuments']);

// Verify Email
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail']);

// Login User
Route::post('/login', [AuthController::class, 'loginUser']);

// Check Email for Forgot Password
Route::post('/check_email', [ForgotPasswordController::class, 'checkEmail']);

// Reset Password
Route::post('/reset_password', [ForgotPasswordController::class, 'resetPassword']);


// Home API
Route::get('/home', [HomeController::class, 'getHomeData']);



// News APIs
Route::get('/news', [NewsController::class, 'getAllNews']);    // Get all News
Route::get('/latest-news', [NewsController::class, 'getLatestNews']);    // Get latest News
Route::post('/upload-news-image', [NewsController::class, 'uploadNewsImage']);  // Upload News Image
Route::post('/add-news', [NewsController::class, 'store']); // Add News

// Startup APIs
Route::get('/startups', [StartupController::class, 'getAllStartups']);    // Get all Startups
Route::get('/most-viewed-startups', [StartupController::class, 'getMostViewedStartups']);    // Get most viewed Startups
Route::post('/upload-startup-image', [StartupController::class, 'uploadStartupImage']);  // Upload Startup Image
Route::post('/add-startup', [StartupController::class, 'addStartup']); // Add Startup
Route::get('/startups/{id}', [StartupController::class, 'getStartup']); // Get Startup By ID
Route::get('/explore-all-startup', [StartupController::class, 'exploreAllStartup']); // Explore all Startups

// Venture Capital APIs
Route::post('/add-venture-capital', [VentureCapitalController::class, 'addVentureCapitalDetails']); // Add Venture Capital
Route::get('/index-venture-capitals', [VentureCapitalController::class, 'indexVentureCapitals']);   // Index Venture Capitals
Route::get('/venture-capital-details/{id}', [VentureCapitalController::class, 'getVentureCapitalDetails']);  // Get Venture Capital Details

// Startup Portfolio for Venture Capital
Route::post('/add-startup-portfolio', [PortfolioController::class, 'addStartupPortfolio']);  // Add Startup Portfolio
