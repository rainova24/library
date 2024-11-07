<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookInstanceController;

// Route untuk homepage
Route::get('/', function () {
    return view('welcome');
});

// Route untuk dashboard dengan middleware auth
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

// Resource routes untuk buku, kategori, dan book instances
Route::resources([
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'bookinstances' => BookInstanceController::class,
]);

// Tambahkan route untuk ekspor buku
Route::get('/books/export', [BookController::class, 'export'])->name('books.export');

// Jika Anda memerlukan route untuk book copies, tambahkan di sini
// Contoh:
// Route::resource('book-copies', BookCopyController::class);
