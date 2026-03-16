{{-- resources/views/questions/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3>Edit Question</h3>
        <a href="{{ route('questions-manage.index') }}" class="btn btn-secondary mt-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <h5>Please fix the following errors:</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-warning">
            <h5 class="mb-0">Edit Question #{{ $question->id }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('questions-manage.update', $question->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <select name="subject" class="form-control @error('subject') is-invalid @enderror" required>
                            <option value="">Select Subject</option>
                            <option value="Science" {{ old('subject', $question->subject) == 'Science' ? 'selected' : '' }}>Science</option>
                            <option value="History" {{ old('subject', $question->subject) == 'History' ? 'selected' : '' }}>History</option>
                            <option value="Geography" {{ old('subject', $question->subject) == 'Geography' ? 'selected' : '' }}>Geography</option>
                            <option value="General Knowledge" {{ old('subject', $question->subject) == 'General Knowledge' ? 'selected' : '' }}>General Knowledge</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Question (English) <span class="text-danger">*</span></label>
                        <textarea name="question_en" class="form-control @error('question_en') is-invalid @enderror" rows="3" required>{{ old('question_en', $question->question_en) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Question (Sinhala) <span class="text-danger">*</span></label>
                        <textarea name="question_si" class="form-control @error('question_si') is-invalid @enderror" rows="3" required>{{ old('question_si', $question->question_si) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Question (Tamil) <span class="text-danger">*</span></label>
                        <textarea name="question_ta" class="form-control @error('question_ta') is-invalid @enderror" rows="3" required>{{ old('question_ta', $question->question_ta) }}</textarea>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Option A (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_en" class="form-control @error('option_a_en') is-invalid @enderror" value="{{ old('option_a_en', $options['a']->option_en ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option A (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_si" class="form-control @error('option_a_si') is-invalid @enderror" value="{{ old('option_a_si', $options['a']->option_si ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option A (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_ta" class="form-control @error('option_a_ta') is-invalid @enderror" value="{{ old('option_a_ta', $options['a']->option_ta ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Option B (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_en" class="form-control @error('option_b_en') is-invalid @enderror" value="{{ old('option_b_en', $options['b']->option_en ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option B (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_si" class="form-control @error('option_b_si') is-invalid @enderror" value="{{ old('option_b_si', $options['b']->option_si ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option B (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_ta" class="form-control @error('option_b_ta') is-invalid @enderror" value="{{ old('option_b_ta', $options['b']->option_ta ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Option C (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_en" class="form-control @error('option_c_en') is-invalid @enderror" value="{{ old('option_c_en', $options['c']->option_en ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option C (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_si" class="form-control @error('option_c_si') is-invalid @enderror" value="{{ old('option_c_si', $options['c']->option_si ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option C (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_ta" class="form-control @error('option_c_ta') is-invalid @enderror" value="{{ old('option_c_ta', $options['c']->option_ta ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Option D (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_en" class="form-control @error('option_d_en') is-invalid @enderror" value="{{ old('option_d_en', $options['d']->option_en ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option D (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_si" class="form-control @error('option_d_si') is-invalid @enderror" value="{{ old('option_d_si', $options['d']->option_si ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Option D (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_ta" class="form-control @error('option_d_ta') is-invalid @enderror" value="{{ old('option_d_ta', $options['d']->option_ta ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Correct Answer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Correct Option Letter <span class="text-danger">*</span></label>
                                <select name="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="a" {{ old('correct_answer', $question->correctAnswer->answer_letter ?? '') == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="b" {{ old('correct_answer', $question->correctAnswer->answer_letter ?? '') == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="c" {{ old('correct_answer', $question->correctAnswer->answer_letter ?? '') == 'c' ? 'selected' : '' }}>C</option>
                                    <option value="d" {{ old('correct_answer', $question->correctAnswer->answer_letter ?? '') == 'd' ? 'selected' : '' }}>D</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Answer Text (English) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_en" class="form-control @error('correct_answer_text_en') is-invalid @enderror" value="{{ old('correct_answer_text_en', $question->correctAnswer->answer_text_en ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Answer Text (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_si" class="form-control @error('correct_answer_text_si') is-invalid @enderror" value="{{ old('correct_answer_text_si', $question->correctAnswer->answer_text_si ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Answer Text (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_ta" class="form-control @error('correct_answer_text_ta') is-invalid @enderror" value="{{ old('correct_answer_text_ta', $question->correctAnswer->answer_text_ta ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Update Question
                    </button>
                    <a href="{{ route('questions-manage.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection