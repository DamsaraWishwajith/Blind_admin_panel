{{-- resources/views/questions/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3>Add New Question</h3>
        <a href="{{ route('questions-manage.index') }}" class="btn btn-secondary mt-2">
            <i class="bi bi-arrow-left"></i> Back to List
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

    @if($errors->any())
        <div class="alert alert-danger">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following errors:</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-question-circle me-2"></i>Question Details</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('questions-manage.store') }}" id="questionForm">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                        <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                            <option value="">-- Select Subject --</option>
                            <option value="Science" {{ old('subject') == 'Science' ? 'selected' : '' }}>🔬 Science</option>
                            <option value="History" {{ old('subject') == 'History' ? 'selected' : '' }}>📜 History</option>
                            <option value="Geography" {{ old('subject') == 'Geography' ? 'selected' : '' }}>🌍 Geography</option>
                            <option value="General Knowledge" {{ old('subject') == 'General Knowledge' ? 'selected' : '' }}>📚 General Knowledge</option>
                        </select>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Question (English) <span class="text-danger">*</span></label>
                        <textarea name="question_en" class="form-control @error('question_en') is-invalid @enderror" rows="3" placeholder="Enter question in English" required>{{ old('question_en') }}</textarea>
                        @error('question_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Question (Sinhala) <span class="text-danger">*</span></label>
                        <textarea name="question_si" class="form-control @error('question_si') is-invalid @enderror" rows="3" placeholder="Enter question in Sinhala" required>{{ old('question_si') }}</textarea>
                        @error('question_si')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Question (Tamil) <span class="text-danger">*</span></label>
                        <textarea name="question_ta" class="form-control @error('question_ta') is-invalid @enderror" rows="3" placeholder="Enter question in Tamil" required>{{ old('question_ta') }}</textarea>
                        @error('question_ta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Option A (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_en" class="form-control @error('option_a_en') is-invalid @enderror" value="{{ old('option_a_en') }}" placeholder="Option A in English" required>
                                @error('option_a_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Option A (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_si" class="form-control @error('option_a_si') is-invalid @enderror" value="{{ old('option_a_si') }}" placeholder="Option A in Sinhala" required>
                                @error('option_a_si')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Option A (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_a_ta" class="form-control @error('option_a_ta') is-invalid @enderror" value="{{ old('option_a_ta') }}" placeholder="Option A in Tamil" required>
                                @error('option_a_ta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-success">Option B (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_en" class="form-control @error('option_b_en') is-invalid @enderror" value="{{ old('option_b_en') }}" placeholder="Option B in English" required>
                                @error('option_b_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-success">Option B (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_si" class="form-control @error('option_b_si') is-invalid @enderror" value="{{ old('option_b_si') }}" placeholder="Option B in Sinhala" required>
                                @error('option_b_si')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-success">Option B (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_b_ta" class="form-control @error('option_b_ta') is-invalid @enderror" value="{{ old('option_b_ta') }}" placeholder="Option B in Tamil" required>
                                @error('option_b_ta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-warning">Option C (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_en" class="form-control @error('option_c_en') is-invalid @enderror" value="{{ old('option_c_en') }}" placeholder="Option C in English" required>
                                @error('option_c_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-warning">Option C (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_si" class="form-control @error('option_c_si') is-invalid @enderror" value="{{ old('option_c_si') }}" placeholder="Option C in Sinhala" required>
                                @error('option_c_si')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-warning">Option C (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_c_ta" class="form-control @error('option_c_ta') is-invalid @enderror" value="{{ old('option_c_ta') }}" placeholder="Option C in Tamil" required>
                                @error('option_c_ta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-danger">Option D (English) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_en" class="form-control @error('option_d_en') is-invalid @enderror" value="{{ old('option_d_en') }}" placeholder="Option D in English" required>
                                @error('option_d_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-danger">Option D (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_si" class="form-control @error('option_d_si') is-invalid @enderror" value="{{ old('option_d_si') }}" placeholder="Option D in Sinhala" required>
                                @error('option_d_si')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-danger">Option D (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="option_d_ta" class="form-control @error('option_d_ta') is-invalid @enderror" value="{{ old('option_d_ta') }}" placeholder="Option D in Tamil" required>
                                @error('option_d_ta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-check-circle me-2"></i>Correct Answer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Correct Option Letter <span class="text-danger">*</span></label>
                                <select name="correct_answer" class="form-select @error('correct_answer') is-invalid @enderror" required>
                                    <option value="">-- Select Correct Option --</option>
                                    <option value="a" {{ old('correct_answer') == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="b" {{ old('correct_answer') == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="c" {{ old('correct_answer') == 'c' ? 'selected' : '' }}>C</option>
                                    <option value="d" {{ old('correct_answer') == 'd' ? 'selected' : '' }}>D</option>
                                </select>
                                @error('correct_answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Answer Text (English) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_en" class="form-control @error('correct_answer_text_en') is-invalid @enderror" value="{{ old('correct_answer_text_en') }}" placeholder="Correct answer in English" required>
                                @error('correct_answer_text_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Answer Text (Sinhala) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_si" class="form-control @error('correct_answer_text_si') is-invalid @enderror" value="{{ old('correct_answer_text_si') }}" placeholder="Correct answer in Sinhala" required>
                                @error('correct_answer_text_si')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Answer Text (Tamil) <span class="text-danger">*</span></label>
                                <input type="text" name="correct_answer_text_ta" class="form-control @error('correct_answer_text_ta') is-invalid @enderror" value="{{ old('correct_answer_text_ta') }}" placeholder="Correct answer in Tamil" required>
                                @error('correct_answer_text_ta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-2"></i> Save Question
                    </button>
                    <a href="{{ route('questions-manage.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Optional: Add form validation before submit
    document.getElementById('questionForm').addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = document.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
</script>
@endpush
@endsection