@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Add IQ Question</h3>

        <form method="POST" action="{{ route('questions.store') }}">

            @csrf

            <div class="mb-3">
                <label>Question English</label>
                <textarea name="question_en" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Question Sinhala</label>
                <textarea name="question_si" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Question Tamil</label>
                <textarea name="question_ta" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Answer English</label>
                <textarea name="answer_en" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Answer Sinhala</label>
                <textarea name="answer_si" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Answer Tamil</label>
                <textarea name="answer_ta" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">
                Save Question
            </button>

        </form>

    </div>

@endsection
