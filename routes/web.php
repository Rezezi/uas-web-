<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route untuk halaman utama yang menampilkan daftar buku
Route::get('/', [UserController::class, 'index'])->name('user.books');

// Route untuk CRUD buku (untuk admin)
Route::resource('books', BookController::class);

// Route untuk peminjaman dan pengembalian buku oleh user (harus login)
Route::middleware(['auth'])->group(function () {
    // Route untuk memproses peminjaman buku
    Route::post('/borrow/{id}', [UserController::class, 'borrow'])->name('user.borrow');

    // Route untuk memproses pengembalian buku
    Route::post('/return/{id}', [UserController::class, 'returnBook'])->name('user.return');

    // Route untuk menampilkan daftar buku yang sedang dipinjam oleh user
    Route::get('/user/borrowed-books', [UserController::class, 'borrowedBooks'])->name('user.borrowed.books');

    // Route tambahan untuk halaman riwayat peminjaman
    Route::get('/user/history', [UserController::class, 'history'])->name('user.history');

    // Route tambahan untuk halaman keranjang
    Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
});

// Rute untuk login dan registrasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect ke halaman utama setelah logout
})->name('logout');
