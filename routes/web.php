<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckCustomer;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductBrandsController;
use App\Http\Controllers\Product1Controller;
use App\Http\Controllers\ProductOstypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE PUBLIK (BISA DIAKSES SEMUA ORANG) ---
// INI ADALAH RUTE UNTUK HALAMAN UTAMA ANDA
Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// --- RUTE AUTENTIKASI ---
Route::controller(CustomerAuthController::class)->prefix('customer')->name('customer.')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// --- RUTE YANG MEMERLUKAN LOGIN ---
Route::middleware([CheckCustomer::class])->group(function () {

    Route::controller(CartController::class)->group(function () {
        Route::post('cart/add/{product}', 'add')->name('cart.add');
        Route::get('cart', 'index')->name('cart.index');
        Route::patch('cart/update/{id}', 'update')->name('cart.update');
        Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');
        Route::post('cart/checkout', 'checkout')->name('cart.checkout');
    });
});

// --- RUTE UNTUK DASHBOARD ---

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
   Route::resource('brand', ProductBrandsController::class);
   Route::resource('product1', Product1Controller::class);
   Route::resource('ostype', controller: ProductOstypeController::class);
});

// untuk dashboard dan pengaturan

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';