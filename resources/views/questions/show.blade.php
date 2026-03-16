{{-- resources/views/questions/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3>View Question</h3>
        <a href="{{ route('questions-manage.index') }}" class="btn btn-secondary mt-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Question #{{ $question->id }} Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $question->id }}</td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td>
                        <span class="badge bg-primary">{{ $question->subject }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Question (English)</th>
                    <td>{{ $question->question_en }}</td>
                </tr>
                <tr>
                    <th>Question (Sinhala)</th>
                    <td>{{ $question->question_si }}</td>
                </tr>
                <tr>
                    <th>Question (Tamil)</th>
                    <td>{{ $question->question_ta }}</td>
                </tr>
            </table>

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Options</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Option</th>
                                <th>English</th>
                                <th>Sinhala</th>
                                <th>Tamil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($question->options as $option)
                            <tr>
                                <td>
                                    <strong>{{ strtoupper($option->option_letter) }}</strong>
                                    @if($question->correctAnswer && $question->correctAnswer->answer_letter == $option->option_letter)
                                        <span class="badge bg-success ms-2">Correct</span>
                                    @endif
                                </td>
                                <td>{{ $option->option_en }}</td>
                                <td>{{ $option->option_si }}</td>
                                <td>{{ $option->option_ta }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Correct Answer</h5>
                </div>
                <div class="card-body">
                    @if($question->correctAnswer)
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px;">Option Letter</th>
                                <td>
                                    <span class="badge bg-success" style="font-size: 1.2rem;">{{ strtoupper($question->correctAnswer->answer_letter) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Answer Text (English)</th>
                                <td>{{ $question->correctAnswer->answer_text_en }}</td>
                            </tr>
                            <tr>
                                <th>Answer Text (Sinhala)</th>
                                <td>{{ $question->correctAnswer->answer_text_si }}</td>
                            </tr>
                            <tr>
                                <th>Answer Text (Tamil)</th>
                                <td>{{ $question->correctAnswer->answer_text_ta }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">No correct answer set for this question.</div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('questions-manage.edit', $question->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('questions-manage.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question? This will also delete all options and correct answers.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection