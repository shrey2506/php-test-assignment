<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Dashboard route – displays the dashboard with authors table and user profile info.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Authors routes
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index'); // (Optional dedicated list)
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

// Book routes
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Logout route
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');
