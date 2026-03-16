<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Mail;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
use App\Http\Controllers\Api\IqQuestionController;

Route::get('/iq-questions', [IqQuestionController::class, 'index']);          // All questions
Route::get('/iq-questions/random', [IqQuestionController::class, 'random']);  // Single random Q
Route::get('/iq-questions/lang/{lang}', [IqQuestionController::class, 'getByLanguage']);
    
use App\Http\Controllers\Api\MathQuestionController;

Route::get('/math-questions', [MathQuestionController::class, 'index']);
Route::get('/math-questions/{difficulty}', [MathQuestionController::class, 'getByDifficulty']);

use App\Http\Controllers\Api\QuizQuestionController;

Route::get('/quiz-questions', [QuizQuestionController::class, 'index']);
Route::get('/quiz-questions/{subject}', [QuizQuestionController::class, 'bySubject']);

use App\Http\Controllers\Api\QuestionController;

Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);

