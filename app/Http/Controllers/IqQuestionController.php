<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IqQuestion;

class IqQuestionController extends Controller
{
    public function index()
    {
        $questions = IqQuestion::latest()->paginate(10);
        return view('iq_questions.index', compact('questions'));
    }

    public function create()
    {
        return view('iq_questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required',
            'question_si' => 'required',
            'question_ta' => 'required',
            'answer_en' => 'required',
            'answer_si' => 'required',
            'answer_ta' => 'required'
        ]);

        IqQuestion::create($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'Question Added Successfully');
    }
}
