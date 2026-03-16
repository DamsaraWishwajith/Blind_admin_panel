{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>IQ Questions</h5>
                    <p class="text-muted">Manage IQ Questions</p>
                    <a href="{{ route('questions.index') }}" class="btn btn-primary btn-sm">
                        View IQ
                    </a>
                    <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm mt-2">
                        Add IQ
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Math Questions</h5>
                    <p class="text-muted">Manage Math Questions</p>
                    <a href="{{ route('math.index') }}" class="btn btn-success btn-sm">
                        View Math
                    </a>
                    <a href="{{ route('math.create') }}" class="btn btn-outline-success btn-sm mt-2">
                        Add Math
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Question Bank</h5>
                    <p class="text-muted">Questions with Options</p>
                    <a href="{{ route('questions-manage.index') }}" class="btn btn-info btn-sm">
                        View All
                    </a>
                    <a href="{{ route('questions-manage.create') }}" class="btn btn-outline-info btn-sm mt-2">
                        Add Question
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Quick Stats</h5>
                </div>
                <div class="card-body">
                    <p>Welcome to the Admin Panel. Use the sidebar to navigate.</p>
                </div>
            </div>
        </div>
    </div>
@endsection