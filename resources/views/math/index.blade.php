{{-- resources/views/math/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-calculator-fill me-2"></i>Math Questions</h3>
        <a href="{{ route('math.create') }}" class="btn btn-primary">
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
            <h5 class="mb-0"><i class="bi bi-table me-2"></i>All Math Questions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">ID</th>
                            <th width="100">Difficulty</th>
                            <th>Question (English)</th>
                            <th width="200">Answer (EN)</th>
                            <th width="100">Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $question)
                        <tr>
                            <td class="fw-bold">{{ $question->id }}</td>
                            <td>
                                @if($question->difficulty == 'easy')
                                    <span class="badge bg-success p-2 w-100">Easy</span>
                                @elseif($question->difficulty == 'medium')
                                    <span class="badge bg-warning text-dark p-2 w-100">Medium</span>
                                @else
                                    <span class="badge bg-danger p-2 w-100">Hard</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;" title="{{ $question->question_en }}">
                                    {{ Str::limit($question->question_en, 60) }}
                                </div>
                                <small class="text-muted">ID: {{ $question->id }}</small>
                            </td>
                            <td>
                                @php
                                    // Check if answer_en is JSON string or array
                                    $answers = is_array($question->answer_en) ? $question->answer_en : json_decode($question->answer_en, true);
                                    $answerText = is_array($answers) ? implode(', ', $answers) : $question->answer_en;
                                @endphp
                                <span class="badge bg-info text-dark p-2">{{ Str::limit($answerText, 30) }}</span>
                            </td>
                            <td>{{ $question->created_at ? $question->created_at->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('math.edit', $question->id) }}" 
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
                                                <p class="fw-bold">Are you sure you want to delete this math question?</p>
                                                <div class="alert alert-warning">
                                                    <p class="mb-0"><strong>Question:</strong> {{ Str::limit($question->question_en, 100) }}</p>
                                                    <p class="mb-0 mt-2"><strong>Answer:</strong> {{ Str::limit($answerText, 50) }}</p>
                                                </div>
                                                <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                                </button>
                                                <form action="{{ route('math.destroy', $question->id) }}" method="POST" class="d-inline">
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
                                <i class="bi bi-calculator display-1 text-muted"></i>
                                <p class="mt-3 text-muted">No math questions found. Click "Add New Question" to create one.</p>
                                <a href="{{ route('math.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add Your First Math Question
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links with Info -->
            @if($questions->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-3 mb-md-0">
                    <p class="text-muted mb-0">
                        Showing <span class="fw-bold">{{ $questions->firstItem() }}</span> 
                        to <span class="fw-bold">{{ $questions->lastItem() }}</span> 
                        of <span class="fw-bold">{{ $questions->total() }}</span> questions
                    </p>
                </div>
                <div>
                    {{ $questions->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @else
            <div class="mt-3">
                <p class="text-muted text-center">
                    Total <span class="fw-bold">{{ $questions->total() }}</span> questions
                </p>
            </div>
            @endif
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