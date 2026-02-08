<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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










































Route::middleware('admin')->group(function () {

    // Admin Dashboard Route
    Route::get('/admin/dashboard', function () {
        // Only allow access if the user is admin
        if (Auth::user() && Auth::user()->is_admin) {
            return view('admin.dashboard');
        }
        return redirect('/');
    })->name('admin.dashboard');

    // Admin Profile Route
    Route::get('/admin/profile', function () {
        // Only allow access if the user is admin
        if (Auth::user() && Auth::user()->is_admin) {
            return view('admin.profile');
        }
        return redirect('/');
    });

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Show all products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Show form to create a product
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Store a new product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Show form to edit product
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Update product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Delete product

  /*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // Show all categories
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Show form to create a category
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store'); // Store a new category
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Show form to edit category
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Update category
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Delete category

});





// Authentication routes
// Disable registration route
Auth::routes(['register' => false, 'login'  =>  false]);


// Custom Auth routes for admin login and logout
Route::get('/login_form', [AuthController::class, 'showLoginForm'])->name('login_form');
Route::post('/admin_login', [AuthController::class, 'admin_login'])->name('admin_login');
Route::post('/admin_logout', [AuthController::class, 'admin_logout'])->name('admin_logout');







// Vue.js route - catches all routes that don't match the above
Route::get('/{any}', function () {
    return view('welcome'); // Your main Vue.js app entry point
})->where('any', '.*');
