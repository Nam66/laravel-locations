@extends('layouts.app')

@section('title', 'Create Location')
@section('page-title', 'Create Location')

@section('content')

{{-- Page header --}}
<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4>Create Location</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Form card --}}
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New Location</h5>
            </div>

            <form action="{{ route('locations.store') }}" method="POST">
                @csrf

                <div class="card-body border-top">
                    {{-- Location Name --}}
                    <div class="mb-3">
                        <label class="form-label">Location Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Enter location name"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Latitude --}}
                    <div class="mb-3">
                        <label class="form-label">Latitude <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="latitude" 
                               step="0.0000001"
                               class="form-control @error('latitude') is-invalid @enderror" 
                               placeholder="e.g., 21.0285"
                               value="{{ old('latitude') }}"
                               required>
                        <div class="form-text text-muted">Geographic latitude coordinate</div>
                        @error('latitude')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Longitude --}}
                    <div class="mb-3">
                        <label class="form-label">Longitude <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="longitude" 
                               step="0.0000001"
                               class="form-control @error('longitude') is-invalid @enderror" 
                               placeholder="e.g., 105.8542"
                               value="{{ old('longitude') }}"
                               required>
                        <div class="form-text text-muted">Geographic longitude coordinate</div>
                        @error('longitude')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" 
                                class="form-control @error('status') is-invalid @enderror"
                                required>
                            <option value="">-- Select Status --</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" @selected(old('status') === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Form actions --}}
                <div class="card-footer d-flex gap-2 justify-content-end">
                    <a href="{{ route('locations.index') }}" class="btn btn-secondary">
                        <i class="ph-x me-1"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-check me-1"></i>
                        Create Location
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
