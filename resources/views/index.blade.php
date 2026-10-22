@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4>Dashboard</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Overview</li>
            </ol>
        </nav>
    </div>
    <span class="badge bg-primary-subtle text-primary" style="font-size:12px;padding:6px 12px">
        <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}
    </span>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex justify-content-between align-items-center"
             style="background: linear-gradient(135deg, #4f81f4, #3a6ae0)">
            <div>
                <div class="stat-number">{{ $totalLocations }}</div>
                <div class="stat-label">Total Locations</div>
            </div>
            <i class="bi bi-geo-alt stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex justify-content-between align-items-center"
             style="background: linear-gradient(135deg, #28a745, #1e8c3a)">
            <div>
                <div class="stat-number">{{ $activeLocations }}</div>
                <div class="stat-label">Active</div>
            </div>
            <i class="bi bi-check-circle stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex justify-content-between align-items-center"
             style="background: linear-gradient(135deg, #fd7e14, #e06000)">
            <div>
                <div class="stat-number">{{ $pendingLocations }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <i class="bi bi-hourglass-split stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex justify-content-between align-items-center"
             style="background: linear-gradient(135deg, #dc3545, #b02a37)">
            <div>
                <div class="stat-number">{{ $suspendedLocations }}</div>
                <div class="stat-label">Suspended</div>
            </div>
            <i class="bi bi-slash-circle stat-icon"></i>
        </div>
    </div>
</div>

<!-- Quick Actions + System Info -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-lightning text-warning"></i> Quick Actions
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('locations.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Add New Location
                    </a>
                    <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-table me-1"></i>View All Locations
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-person-gear me-1"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-info-circle text-primary"></i> System Info
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:50%">Logged in as</td>
                        <td><strong>{{ auth()->user()->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Daily reset</td>
                        <td><span class="badge bg-success-subtle text-success">Enabled (00:00)</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Laravel version</td>
                        <td>{{ app()->version() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
