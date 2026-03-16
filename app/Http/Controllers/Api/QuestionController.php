<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    // Get all questions
    public function index()
    {
        $questions = Question::with(['options', 'correctAnswer'])->get();

        return response()->json($questions);
    }

    // Get single question by ID
    public function show($id)
    {
        $question = Question::with(['options', 'correctAnswer'])
            ->where('id', $id)
            ->firstOrFail();

        return response()->json($question);
    }
}
