<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Dashboard route – displays the dashboard with the authors table.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Authors routes
// This route will display a dedicated list of authors (if needed)
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
// Route for viewing a single author and their books
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
// Route for deleting an author (only allowed if there are no related books)
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

// Logout route: clears the session and redirects to login.
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');
