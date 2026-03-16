{{-- resources/views/math/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3>View Math Question</h3>
        <a href="{{ route('math.index') }}" class="btn btn-secondary mt-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Question Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 150px;">ID</th>
                    <td>{{ $question->id }}</td>
                </tr>
                <tr>
                    <th>Difficulty</th>
                    <td>
                        @if($question->difficulty == 'easy')
                            <span class="badge bg-success">Easy</span>
                        @elseif($question->difficulty == 'medium')
                            <span class="badge bg-warning text-dark">Medium</span>
                        @else
                            <span class="badge bg-danger">Hard</span>
                        @endif
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
                <tr>
                    <th>Answer (English)</th>
                    <td>{{ $question->answer_en }}</td>
                </tr>
                <tr>
                    <th>Answer (Sinhala)</th>
                    <td>{{ $question->answer_si }}</td>
                </tr>
                <tr>
                    <th>Answer (Tamil)</th>
                    <td>{{ $question->answer_ta }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $question->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $question->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('math.edit', $question->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('math.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question?');">
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