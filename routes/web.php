<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
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

// Public route (accessible to all users)
Route::get('/', [WelcomeController::class, 'create'])->name('welcome');
Route::get('/view/{id}', [WelcomeController::class, 'show'])->name('view');


// Dashboard - only for authenticated, verified, and admin users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'checkadmin'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

});

// Profile routes - only for authenticated users
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

// Admin-only routes (authenticated, verified, and checkadmin middleware)
Route::middleware(['auth', 'verified', 'checkadmin'])->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);

    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('orders', \App\Http\Controllers\OrderController::class);


    Route::resource('badges', \App\Http\Controllers\BadgeController::class);
    Route::resource('offers', \App\Http\Controllers\OfferController::class);

    Route::get('/admin/badges/assign', [BadgeController::class, 'assignForm'])->name('badges.assign');
    Route::post('/admin/badges/assign', [BadgeController::class, 'assign']);



// Show all About Us entries
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');

// Show form to create a new entry
    Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('about-us.create');

// Store new entry
    Route::post('/about-us/store', [AboutUsController::class, 'store'])->name('about-us.store');

// Show form to edit an existing entry
    Route::get('/about-us/edit/{id}', [AboutUsController::class, 'edit'])->name('about-us.edit');

// Update an existing entry
    Route::post('/about-us/update/{id}', [AboutUsController::class, 'update'])->name('about-us.update');

// Delete an entry
    Route::get('/about-us/delete/{id}', [AboutUsController::class, 'destroy'])->name('about-us.destroy');





});

Route::middleware(['auth'])->group(function () {
    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/failure', [ CheckoutController::class, 'failure'])->name('failure');
});

Route::middleware(['auth', 'verified', 'checkadmin'])->group(function () {
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
});
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware(['auth', 'verified']);
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
//Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::get('/buy-now/', [BuyController::class, 'buyNow'])->name('buy.now');

Route::get('carts', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
