@extends('layouts.auth')

@section('auth-content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required autofocus>
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

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <!-- Register Link -->
        <div class="text-center mt-3">
            <p class="mb-0">Don't have an account?
                <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                    Register here
                </a>
            </p>
        </div>

        <!-- Forgot Password Link -->
        <div class="text-center mt-2">
            <a href="{{ route('password.request') }}" class="text-secondary text-decoration-none small">
                Forgot Your Password?
            </a>
        </div>
    </form>
@endsection
