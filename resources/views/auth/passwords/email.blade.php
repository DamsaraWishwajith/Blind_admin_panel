@extends('layouts.auth')

@section('auth-content')
    <div class="mb-4 text-sm text-secondary">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Send Password Reset Link
        </button>

        <!-- Back to Login Link -->
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                ← Back to Login
            </a>
        </div>
    </form>
@endsection
