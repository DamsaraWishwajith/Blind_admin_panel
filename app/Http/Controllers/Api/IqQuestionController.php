<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IqQuestion;

class IqQuestionController extends Controller
{
    public function index()
    {
        return response()->json([
            "success" => true,
            "data" => IqQuestion::all()
        ]);
    }

    public function random()
    {
        return response()->json([
            "success" => true,
            "data" => IqQuestion::inRandomOrder()->first()
        ]);
    }

    public function getByLanguage($lang)
    {
        $questions = IqQuestion::select(
            "id",
            "question_$lang as question",
            "answer_$lang as answers"
        )->get();

        return response()->json([
            "success" => true,
            "language" => $lang,
            "data" => $questions
        ]);
    }
}
