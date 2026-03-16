<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    // Get all questions
    public function index()
    {
        $questions = DB::table('questions')->get();
        return response()->json($questions);
    }

    // Get questions by subject
    public function bySubject($subject)
    {
        $questions = DB::table('questions')
            ->where('subject', $subject)
            ->get();

        if ($questions->isEmpty()) {
            return response()->json(['message' => 'No questions found for this subject'], 404);
        }

        return response()->json($questions);
    }
}
