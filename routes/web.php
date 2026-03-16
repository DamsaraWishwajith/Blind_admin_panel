<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IqQuestionController;
use App\Http\Controllers\MathQuestionController;
use App\Http\Controllers\QuestionController; // Add this
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

    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // IQ Questions resource routes
    Route::resource('questions', IqQuestionController::class);

    // Math Questions resource routes
    Route::resource('math', MathQuestionController::class);

    // Questions Management (with options and correct answers)
    Route::resource('questions-manage', QuestionController::class);

    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});