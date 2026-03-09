@extends('layouts.auth')

@section('auth-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>

        <!-- Login Link -->
        <div class="text-center mt-3">
            <p class="mb-0">Already have an account?
                <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                    Login here
                </a>
            </p>
        </div>

        <!-- Optional: Link to Terms & Conditions -->
        <div class="text-center mt-4 small text-secondary">
            By registering, you agree to our
            <a href="#" class="text-secondary">Terms of Service</a> and
            <a href="#" class="text-secondary">Privacy Policy</a>
        </div>
    </form>
@endsection
