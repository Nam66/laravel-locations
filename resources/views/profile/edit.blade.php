@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')

{{-- Page header --}}
<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4>Edit Profile</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Form card --}}
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Your Profile</h5>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body border-top">
                    {{-- Full Name --}}
                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Enter your full name"
                               value="{{ old('name', Auth::user()->name) }}"
                               required>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="Enter your email address"
                               value="{{ old('email', Auth::user()->email) }}"
                               required>
                        <div class="form-text text-muted">We'll never share your email with anyone else</div>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $value => $label)
                            <label class="form-check form-check-inline">
                                <input type="radio" 
                                       class="form-check-input" 
                                       name="gender" 
                                       value="{{ $value }}"
                                       @checked(old('gender', Auth::user()->gender) === $value)>
                                <span class="form-check-label">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('gender')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Avatar --}}
                    <div class="mb-3">
                        <label class="form-label">Profile Avatar</label>
                        <input type="file" 
                               name="avatar"
                               class="form-control @error('avatar') is-invalid @enderror"
                               accept="image/*">
                        <div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2MB</div>
                        @error('avatar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        @if(Auth::user()->avatar)
                        <div class="mt-2">
                            <small class="text-muted">Current avatar:</small>
                            <div class="mt-1">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     alt="Avatar" 
                                     class="img-thumbnail" 
                                     style="max-width: 100px;">
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Password section --}}
                    <fieldset class="mb-3">
                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Change Password (Optional)</legend>

                        {{-- Current Password --}}
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" 
                                   name="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   placeholder="Enter your current password">
                            @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Enter new password">
                            <div class="form-text text-muted">Leave blank to keep your current password</div>
                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   placeholder="Confirm your new password">
                            @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>
                </div>

                {{-- Form actions --}}
                <div class="card-footer d-flex gap-2 justify-content-end">
                    <a href="{{ route('index') }}" class="btn btn-secondary">
                        <i class="ph-x me-1"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-check me-1"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
