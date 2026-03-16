<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MathQuestion;

class MathQuestionController extends Controller
{
    // Get all questions
    public function index()
    {
        $questions = MathQuestion::all();
        return response()->json($questions);
    }

    // Get questions by difficulty (optional)
    public function getByDifficulty($difficulty)
    {
        $questions = MathQuestion::where('difficulty', $difficulty)->get();
        return response()->json($questions);
    }
}
