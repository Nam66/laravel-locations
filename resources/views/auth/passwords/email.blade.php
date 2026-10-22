@extends('layouts.auth')

@section('title', 'Password Recovery')

@section('content')

<form method="POST" action="{{ route('password.email') }}" class="login-form">
    @csrf

    <div class="card mb-0">
        <div class="card-body">

            <!-- Icon & Header -->
            <div class="text-center mb-3">
                <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                    <i class="ph-arrows-counter-clockwise ph-2x"></i>
                </div>
                <h5 class="mb-0">Password recovery</h5>
                <span class="d-block text-muted">We'll send you instructions in email</span>
            </div>

            <!-- Status message -->
            @if (session('status'))
                <div class="alert alert-success alert-styled-left mb-3">
                    <span class="fw-semibold">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Your email</label>
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
                        <i class="ph-at text-muted"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="ph-arrow-counter-clockwise me-2"></i>
                Reset password
            </button>

        </div>
    </div>

</form>

@endsection
