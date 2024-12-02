<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman utama (UserController digunakan sebagai landing page untuk user)
Route::get('/', [UserController::class, 'index'])->name('user.home');

// Route untuk CRUD produk (menggunakan ProductController untuk admin)
Route::resource('products', ProductController::class);

// Route untuk aktivitas user yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.add_to_cart');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('user.cart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.remove_from_cart'); // Menghapus produk dari keranjang
    Route::get('/transaction', [CartController::class, 'transaction'])->name('user.transaction'); // Halaman transaksi
});

// Rute untuk login dan registrasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
