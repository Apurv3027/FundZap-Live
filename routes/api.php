<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\ForgotPasswordController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StartupController;

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

// Login User
Route::post('/login', [AuthController::class, 'loginUser']);

// Check Email for Forgot Password
Route::post('/check_email', [ForgotPasswordController::class, 'checkEmail']);

// Reset Password
Route::post('/reset_password', [ForgotPasswordController::class, 'resetPassword']);



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
