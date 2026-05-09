<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\PaymentController;


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


Route::post('/customer/register', [CustomerController::class, 'register']);
Route::post('/customer/login', [CustomerController::class, 'login']);
Route::post('/customer/verify-otp', [CustomerController::class, 'verifyOtp']);
Route::get('/customer/logout', [CustomerController::class, 'logout']);
Route::post('/customer/update-profile', [CustomerController::class, 'updateProfile']);
Route::post('/customer/resend-otp', [CustomerController::class, 'resendOtp']);
//for forget password

Route::post('forgot-password', [CustomerController::class, 'resetsendOTP']);
Route::post('verify-otp', [CustomerController::class, 'resetverifyOTP']);
Route::post('reset-password', [CustomerController::class, 'resetPassword']);


//categories and porducts 

Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/categories', [CategoryApiController::class, 'index']);
// Route::middleware('auth:sanctum')->post('/customer/update-profile', [CustomerController::class, 'updateProfile']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);









// For session-based authentication (without Sanctum)
Route::post('/initiate-payment', [PaymentController::class, 'initiatePayment'])->middleware('web');

// Route::middleware('auth')->post('/initiate-payment', [PaymentController::class, 'initiatePayment']);