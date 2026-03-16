<?php
// app/Http/Controllers/MathQuestionController.php

namespace App\Http\Controllers;

use App\Models\MathQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MathQuestionController extends Controller
{
    /**
     * Display a listing of the math questions.
     */
    public function index()
    {
        $questions = MathQuestion::orderBy('id', 'desc')->paginate(10);
        return view('math.index', compact('questions'));
    }

    /**
     * Show the form for creating a new math question.
     */
    public function create()
    {
        return view('math.create');
    }

    /**
     * Store a newly created math question in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'difficulty' => 'required|in:easy,medium,hard',
            'question_en' => 'required|string',
            'question_si' => 'required|string',
            'question_ta' => 'required|string',
            'answer_en' => 'required|string',
            'answer_si' => 'required|string',
            'answer_ta' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create without timestamps
        $question = new MathQuestion();
        $question->difficulty = $request->difficulty;
        $question->question_en = $request->question_en;
        $question->question_si = $request->question_si;
        $question->question_ta = $request->question_ta;
        $question->answer_en = $request->answer_en;
        $question->answer_si = $request->answer_si;
        $question->answer_ta = $request->answer_ta;
        $question->save();

        return redirect()->route('math.index')
            ->with('success', 'Math question created successfully.');
    }

    /**
     * Display the specified math question.
     */
    public function show($id)
    {
        $question = MathQuestion::findOrFail($id);
        return view('math.show', compact('question'));
    }

    /**
     * Show the form for editing the specified math question.
     */
    public function edit($id)
    {
        $question = MathQuestion::findOrFail($id);
        return view('math.edit', compact('question'));
    }

    /**
     * Update the specified math question in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'difficulty' => 'required|in:easy,medium,hard',
            'question_en' => 'required|string',
            'question_si' => 'required|string',
            'question_ta' => 'required|string',
            'answer_en' => 'required|string',
            'answer_si' => 'required|string',
            'answer_ta' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $question = MathQuestion::findOrFail($id);
        $question->difficulty = $request->difficulty;
        $question->question_en = $request->question_en;
        $question->question_si = $request->question_si;
        $question->question_ta = $request->question_ta;
        $question->answer_en = $request->answer_en;
        $question->answer_si = $request->answer_si;
        $question->answer_ta = $request->answer_ta;
        $question->save();

        return redirect()->route('math.index')
            ->with('success', 'Math question updated successfully.');
    }

    /**
     * Remove the specified math question from storage.
     */
    public function destroy($id)
    {
        $question = MathQuestion::findOrFail($id);
        $question->delete();

        return redirect()->route('math.index')
            ->with('success', 'Math question deleted successfully.');
    }
}