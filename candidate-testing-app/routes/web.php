<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Route to display the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route to process the login form
Route::post('/login', [LoginController::class, 'login']);

// A simple dashboard page after login
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Logout route: clears session and redirects back to login
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');
