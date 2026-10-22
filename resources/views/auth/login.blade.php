@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<form method="POST" action="{{ route('login') }}" class="login-form">
    @csrf

    <div class="card mb-0">
        <div class="card-body">

            <!-- Logo & Header -->
            <div class="text-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                    <img src="{{ asset('assets/images/logo_icon.svg') }}" class="h-48px" alt="">
                </div>
                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block text-muted">Enter your credentials below</span>
            </div>

            <!-- Status message -->
            @if (session('status'))
                <div class="alert alert-success alert-styled-left mb-3">
                    <span class="fw-semibold">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="john@doe.com"
                        class="form-control @error('email') is-invalid @enderror"
                        autofocus
                        required
                    >
                    <div class="form-control-feedback-icon">
                        <i class="ph-user-circle text-muted"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input
                        type="password"
                        name="password"
                        placeholder="•••••••••••"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >
                    <div class="form-control-feedback-icon">
                        <i class="ph-lock text-muted"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me -->
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">
                        Remember me
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="ph-sign-in me-2"></i>
                    Sign in
                </button>
            </div>

            <!-- Forgot password -->
            <div class="text-center">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>

        </div>
    </div>

</form>

@endsection
