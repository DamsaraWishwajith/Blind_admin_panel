<?php
// app/Http/Controllers/QuestionController.php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\CorrectAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
{
    $query = Question::with(['options', 'correctAnswer']);
    
    // Search functionality
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('question_en', 'LIKE', "%{$search}%")
              ->orWhere('question_si', 'LIKE', "%{$search}%")
              ->orWhere('question_ta', 'LIKE', "%{$search}%")
              ->orWhere('subject', 'LIKE', "%{$search}%");
        });
    }
    
    // Per page functionality
    $perPage = $request->get('per_page', 10);
    $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
    
    $questions = $query->orderBy('id', 'desc')->paginate($perPage);
    
    // Preserve query parameters in pagination links
    $questions->appends($request->query());
    
    return view('questions.index', compact('questions'));
}

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'subject' => 'required|string|max:50',
            'question_en' => 'required|string',
            'question_si' => 'required|string',
            'question_ta' => 'required|string',
            'option_a_en' => 'required|string',
            'option_a_si' => 'required|string',
            'option_a_ta' => 'required|string',
            'option_b_en' => 'required|string',
            'option_b_si' => 'required|string',
            'option_b_ta' => 'required|string',
            'option_c_en' => 'required|string',
            'option_c_si' => 'required|string',
            'option_c_ta' => 'required|string',
            'option_d_en' => 'required|string',
            'option_d_si' => 'required|string',
            'option_d_ta' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
            'correct_answer_text_en' => 'required|string',
            'correct_answer_text_si' => 'required|string',
            'correct_answer_text_ta' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        DB::beginTransaction();

        try {
            // Get the next ID manually
            $maxId = DB::table('questions')->max('id');
            $nextId = $maxId ? $maxId + 1 : 1;

            // 1. Create the question with explicit ID
            $question = new Question();
            $question->id = $nextId;
            $question->subject = $request->subject;
            $question->question_en = $request->question_en;
            $question->question_si = $request->question_si;
            $question->question_ta = $request->question_ta;
            $question->save();

            // 2. Create options
            $optionLetters = ['a', 'b', 'c', 'd'];
            foreach ($optionLetters as $letter) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->option_letter = $letter;
                $option->option_en = $request->{'option_' . $letter . '_en'};
                $option->option_si = $request->{'option_' . $letter . '_si'};
                $option->option_ta = $request->{'option_' . $letter . '_ta'};
                $option->save();
            }

            // 3. Create correct answer
            $correctAnswer = new CorrectAnswer();
            $correctAnswer->question_id = $question->id;
            $correctAnswer->answer_letter = $request->correct_answer;
            $correctAnswer->answer_text_en = $request->correct_answer_text_en;
            $correctAnswer->answer_text_si = $request->correct_answer_text_si;
            $correctAnswer->answer_text_ta = $request->correct_answer_text_ta;
            $correctAnswer->save();

            DB::commit();

            return redirect()->route('questions-manage.index')
                ->with('success', 'Question created successfully! ID: ' . $question->id);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Question creation failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to create question: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        try {
            $question = Question::with(['options', 'correctAnswer'])->findOrFail($id);
            return view('questions.show', compact('question'));
        } catch (\Exception $e) {
            return redirect()->route('questions-manage.index')
                ->with('error', 'Question not found.');
        }
    }

    public function edit($id)
    {
        try {
            $question = Question::with(['options', 'correctAnswer'])->findOrFail($id);
            
            $options = [];
            foreach ($question->options as $option) {
                $options[$option->option_letter] = $option;
            }
            
            return view('questions.edit', compact('question', 'options'));
        } catch (\Exception $e) {
            return redirect()->route('questions-manage.index')
                ->with('error', 'Question not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'subject' => 'required|string|max:50',
            'question_en' => 'required|string',
            'question_si' => 'required|string',
            'question_ta' => 'required|string',
            'option_a_en' => 'required|string',
            'option_a_si' => 'required|string',
            'option_a_ta' => 'required|string',
            'option_b_en' => 'required|string',
            'option_b_si' => 'required|string',
            'option_b_ta' => 'required|string',
            'option_c_en' => 'required|string',
            'option_c_si' => 'required|string',
            'option_c_ta' => 'required|string',
            'option_d_en' => 'required|string',
            'option_d_si' => 'required|string',
            'option_d_ta' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
            'correct_answer_text_en' => 'required|string',
            'correct_answer_text_si' => 'required|string',
            'correct_answer_text_ta' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        DB::beginTransaction();

        try {
            $question = Question::findOrFail($id);
            
            // Update question
            $question->subject = $request->subject;
            $question->question_en = $request->question_en;
            $question->question_si = $request->question_si;
            $question->question_ta = $request->question_ta;
            $question->save();

            // Update options
            $optionLetters = ['a', 'b', 'c', 'd'];
            foreach ($optionLetters as $letter) {
                Option::updateOrCreate(
                    ['question_id' => $question->id, 'option_letter' => $letter],
                    [
                        'option_en' => $request->{'option_' . $letter . '_en'},
                        'option_si' => $request->{'option_' . $letter . '_si'},
                        'option_ta' => $request->{'option_' . $letter . '_ta'},
                    ]
                );
            }

            // Update correct answer
            CorrectAnswer::updateOrCreate(
                ['question_id' => $question->id],
                [
                    'answer_letter' => $request->correct_answer,
                    'answer_text_en' => $request->correct_answer_text_en,
                    'answer_text_si' => $request->correct_answer_text_si,
                    'answer_text_ta' => $request->correct_answer_text_ta,
                ]
            );

            DB::commit();

            return redirect()->route('questions-manage.index')
                ->with('success', 'Question updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Question update failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to update question: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $question = Question::findOrFail($id);
            
            // Delete related records first
            Option::where('question_id', $id)->delete();
            CorrectAnswer::where('question_id', $id)->delete();
            
            // Delete question
            $question->delete();
            
            return redirect()->route('questions-manage.index')
                ->with('success', 'Question deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Question deletion failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to delete question: ' . $e->getMessage());
        }
    }
}