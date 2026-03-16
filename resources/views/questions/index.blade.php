{{-- resources/views/questions/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-question-circle-fill me-2"></i>Question Bank</h3>
        <a href="{{ route('questions-manage.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Add New Question
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="bi bi-table me-2"></i>All Questions</h5>
        </div>
        <div class="card-body">
            <!-- Search and Filter Bar -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('questions-manage.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search questions..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group" role="group">
                        <a href="{{ route('questions-manage.index') }}?per_page=10" class="btn btn-outline-secondary {{ request('per_page', 10) == 10 ? 'active' : '' }}">10</a>
                        <a href="{{ route('questions-manage.index') }}?per_page=25" class="btn btn-outline-secondary {{ request('per_page') == 25 ? 'active' : '' }}">25</a>
                        <a href="{{ route('questions-manage.index') }}?per_page=50" class="btn btn-outline-secondary {{ request('per_page') == 50 ? 'active' : '' }}">50</a>
                        <a href="{{ route('questions-manage.index') }}?per_page=100" class="btn btn-outline-secondary {{ request('per_page') == 100 ? 'active' : '' }}">100</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>
                            <th width="120">Subject</th>
                            <th>Question (English)</th>
                            <th width="180">Correct Answer</th>
                            <th width="100">Options</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $question)
                        <tr>
                            <td class="fw-bold">{{ $question->id }}</td>
                            <td>
                                @php
                                    $subjectColors = [
                                        'Science' => 'primary',
                                        'History' => 'success',
                                        'Geography' => 'info',
                                        'General Knowledge' => 'warning'
                                    ];
                                    $color = $subjectColors[$question->subject] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }} p-2 w-100">
                                    {{ $question->subject }}
                                </span>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;" title="{{ $question->question_en }}">
                                    {{ Str::limit($question->question_en, 80) }}
                                </div>
                                <small class="text-muted">ID: {{ $question->id }}</small>
                            </td>
                            <td class="text-center">
                                @if($question->correctAnswer)
                                    <span class="badge bg-success p-2 mb-1" style="font-size: 0.9rem;">
                                        Option {{ strtoupper($question->correctAnswer->answer_letter) }}
                                    </span>
                                    <br>
                                    <small class="text-muted" title="{{ $question->correctAnswer->answer_text_en }}">
                                        {{ Str::limit($question->correctAnswer->answer_text_en, 25) }}
                                    </small>
                                @else
                                    <span class="badge bg-danger p-2">Not set</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info p-2">
                                    <i class="bi bi-list-ul me-1"></i>4
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('questions-manage.show', $question->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="View Details"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('questions-manage.edit', $question->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit Question"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger" 
                                            title="Delete Question"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $question->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                    Confirm Delete
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fw-bold">Are you sure you want to delete this question?</p>
                                                <div class="alert alert-warning">
                                                    <p class="mb-0"><strong>Question:</strong> {{ Str::limit($question->question_en, 100) }}</p>
                                                    <p class="mb-0 mt-2"><strong>Subject:</strong> {{ $question->subject }}</p>
                                                </div>
                                                <p class="text-danger mb-0"><small>This action cannot be undone. All options and correct answer data will also be deleted.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                                </button>
                                                <form action="{{ route('questions-manage.destroy', $question->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <p class="mt-3 text-muted">No questions found. Click "Add New Question" to create one.</p>
                                <a href="{{ route('questions-manage.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add Your First Question
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination Section -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-3 mb-md-0">
                    <p class="text-muted mb-0">
                        Showing <span class="fw-bold">{{ $questions->firstItem() ?? 0 }}</span> 
                        to <span class="fw-bold">{{ $questions->lastItem() ?? 0 }}</span> 
                        of <span class="fw-bold">{{ $questions->total() }}</span> questions
                    </p>
                    @if(request('search'))
                        <p class="text-muted small mb-0 mt-1">
                            Search results for: "<span class="fw-bold">{{ request('search') }}</span>"
                            <a href="{{ route('questions-manage.index') }}" class="ms-2 text-decoration-none">Clear filter</a>
                        </p>
                    @endif
                </div>
                <div>
                    @if($questions->hasPages())
                        {{ $questions->appends(request()->query())->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted me-3">
                                        <i class="bi bi-grid-3x3-gap-fill me-1"></i>Total: {{ $questions->total() }}
                                    </span>
                                    @php
                                        $scienceCount = \App\Models\Question::where('subject', 'Science')->count();
                                        $historyCount = \App\Models\Question::where('subject', 'History')->count();
                                        $geographyCount = \App\Models\Question::where('subject', 'Geography')->count();
                                        $gkCount = \App\Models\Question::where('subject', 'General Knowledge')->count();
                                    @endphp
                                    <span class="text-muted me-3">
                                        <i class="bi bi-flask me-1"></i>Science: {{ $scienceCount }}
                                    </span>
                                    <span class="text-muted me-3">
                                        <i class="bi bi-book me-1"></i>History: {{ $historyCount }}
                                    </span>
                                    <span class="text-muted me-3">
                                        <i class="bi bi-globe me-1"></i>Geography: {{ $geographyCount }}
                                    </span>
                                    <span class="text-muted">
                                        <i class="bi bi-lightbulb me-1"></i>GK: {{ $gkCount }}
                                    </span>
                                </div>
                                <div>
                                    <select class="form-select form-select-sm" onchange="window.location.href = this.value;" style="width: auto;">
                                        <option value="{{ route('questions-manage.index') }}?per_page=10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                                        <option value="{{ route('questions-manage.index') }}?per_page=25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                                        <option value="{{ route('questions-manage.index') }}?per_page=50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                                        <option value="{{ route('questions-manage.index') }}?per_page=100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    
    // Auto-hide alerts after 5 seconds
    window.setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
@endsection