@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<form method="POST" action="{{ route('password.update') }}" novalidate class="login-form">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="card mb-0">
        <div class="card-body">

            {{-- Logo & Header --}}
            <div class="text-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                    <svg width="48" height="48" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="lg1" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#f97316"/>
                                <stop offset="50%" stop-color="#ec4899"/>
                                <stop offset="100%" stop-color="#6366f1"/>
                            </linearGradient>
                        </defs>
                        <path d="M50 50 C50 34 38 24 28 24 C14 24 6 34 6 50 C6 66 14 76 28 76 C38 76 46 68 50 56 C54 68 62 76 72 76 C86 76 94 66 94 50 C94 34 86 24 72 24 C62 24 54 34 50 50 Z"
                              fill="none" stroke="url(#lg1)" stroke-width="10" stroke-linecap="round"/>
                    </svg>
                </div>
                <h5 class="mb-0">Set a new password</h5>
                <span class="d-block text-muted">Choose a strong password for your account</span>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $email ?? '') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                    >
                    <div class="form-control-feedback-icon">
                        <i class="ph-envelope text-muted"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- New password --}}
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input
                        type="password"
                        name="password"
                        placeholder="Min. 8 characters"
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

            {{-- Confirm password --}}
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="form-control-feedback form-control-feedback-start">
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Repeat new password"
                        class="form-control"
                        required
                    >
                    <div class="form-control-feedback-icon">
                        <i class="ph-lock-key text-muted"></i>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </div>

            {{-- Back to login --}}
            <div class="text-center">
                <a href="{{ route('login') }}" style="color: #2571f6; text-decoration: none; font-size: 0.875rem;">
                    Back to login
                </a>
            </div>

        </div>
    </div>

</form>

@endsection
