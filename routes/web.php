<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
Route::get('/view{id}', [WelcomeController::class, 'show'])->name('view');

Route::get('/profile/edit', function () {
    // return your profile edit view
})->name('profile.edit');

// Dashboard - only for authenticated, verified, and admin users
Route::get('/dashboard', [UserController::class, 'admin'])
    ->middleware(['auth', 'verified', 'checkadmin'])
    ->name('dashboard');

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




});

Route::middleware(['auth'])->group(function () {
    Route::get('/payment-success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/payment-failure', [CheckoutController::class, 'failure'])->name('failure');
});

Route::middleware(['auth', 'verified', 'checkadmin'])->group(function () {
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::resource('about_us', \App\Http\Controllers\AboutUsController::class);
    Route::resource('home_design', \App\Http\Controllers\HomeController::class);
    Route::get('/view', [HomeController::class, 'welcome'])->name('view.home');


});
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware(['auth', 'verified']);
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/searching', [ProductController::class, 'searching'])->name('products.searching');

//Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::prefix('cart')->middleware(['auth'])->group(function () {
    // Display cart
    Route::get('/index', [CartController::class, 'index'])->name('cart.index');

    // Add item to cart
    Route::post('/', [CartController::class, 'store'])->name('cart.store');

    // Update cart item quantity (AJAX)
    Route::post('/{id}', [CartController::class, 'update'])->name('cart.update');

    // Remove single item
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Bulk delete items
    Route::delete('/cart/bulk-delete', [CartController::class, 'bulkDelete'])->name('cart.bulkDelete');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/buy-now', [BuyController::class, 'buyNow'])->name('buy.now');
    Route::get('/search-about-us', [AboutUsController::class, 'search'])->name('about_us.search');
    Route::get('/search/categories', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/search/products', [ProductController::class, 'searchindex'])->name('products.searchindex');
    Route::get('/search/homedesign', [HomeController::class, 'search'])->name('home_design.search');
    Route::get('/search/orders', [OrderController::class, 'search'])->name('orders.search');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

});
Route::get('/collection', [CollectionController::class, 'index'])->name('collection');


//Route::get('/collection', [CollectionController::class, 'show'])->name('collection');

Route::get('/aboutus', [AboutUsController::class, 'view'])->name('aboutus.view');
Route::get('/filter-products', [CollectionController::class, 'filter']);

//Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');


// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
