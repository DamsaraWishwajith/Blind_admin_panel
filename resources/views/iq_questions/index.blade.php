@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>IQ Questions</h3>

        <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">
            Add New Question
        </a>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Question EN</th>
                <th>Answer EN</th>
            </tr>

            @foreach($questions as $q)

                <tr>
                    <td>{{ $q->id }}</td>
                    <td>{{ $q->question_en }}</td>
                    <td>{{ $q->answer_en }}</td>
                </tr>

            @endforeach

        </table>

        {{ $questions->links() }}

    </div>

@endsection
