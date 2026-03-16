{{-- resources/views/math/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3>Edit Math Question</h3>
        <a href="{{ route('math.index') }}" class="btn btn-secondary mt-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('math.update', $question->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Difficulty <span class="text-danger">*</span></label>
                        <select name="difficulty" class="form-control @error('difficulty') is-invalid @enderror" required>
                            <option value="">Select Difficulty</option>
                            <option value="easy" {{ old('difficulty', $question->difficulty) == 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="medium" {{ old('difficulty', $question->difficulty) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="hard" {{ old('difficulty', $question->difficulty) == 'hard' ? 'selected' : '' }}>Hard</option>
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

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Answer (English) <span class="text-danger">*</span></label>
                        <textarea name="answer_en" class="form-control @error('answer_en') is-invalid @enderror" rows="2" required>{{ old('answer_en', $question->answer_en) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Answer (Sinhala) <span class="text-danger">*</span></label>
                        <textarea name="answer_si" class="form-control @error('answer_si') is-invalid @enderror" rows="2" required>{{ old('answer_si', $question->answer_si) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Answer (Tamil) <span class="text-danger">*</span></label>
                        <textarea name="answer_ta" class="form-control @error('answer_ta') is-invalid @enderror" rows="2" required>{{ old('answer_ta', $question->answer_ta) }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Update Question
                </button>
            </form>
        </div>
    </div>
</div>
@endsection