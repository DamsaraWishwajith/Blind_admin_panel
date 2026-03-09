<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IqQuestionController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {

    // Dashboard route - ADD THE NAME HERE
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');  // <-- This is the important part!

    // IQ Questions resource routes
    Route::resource('questions', IqQuestionController::class);

    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
