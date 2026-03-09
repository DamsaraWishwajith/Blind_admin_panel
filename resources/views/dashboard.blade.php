@extends('layouts.app')

@section('content')

    <h2>Dashboard</h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Questions</h5>
                    <p>Manage IQ Questions</p>

                    <a href="{{ route('questions.index') }}" class="btn btn-primary">
                        View Questions
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Add New Question</h5>
                    <p>Create IQ Question</p>

                    <a href="{{ route('questions.create') }}" class="btn btn-success">
                        Add Question
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
