@extends('layouts.app')

@section('title', 'Locations')
@section('page-title', 'Locations')

@section('content')

{{-- Page header --}}
<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4>Locations</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Locations</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('locations.create') }}" class="btn btn-primary btn-sm">
        <i class="ph-plus me-1"></i>Add Location
    </a>
</div>

{{-- Locations table --}}
<div class="card">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="ph-list text-primary"></i>
        Location List
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="locationsTable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 55px">#</th>
                        <th>Name</th>
                        <th style="width: 130px">Latitude</th>
                        <th style="width: 130px">Longitude</th>
                        <th style="width: 110px">Status</th>
                        <th style="width: 100px" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/datatables.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = new DataTable('#locationsTable', {
        serverSide: true,
        ajax: {
            url: '{{ route('locations.index') }}',
            type: 'GET',
            data: function(d) {
                // DataTables sends: draw, start, length, search[value], order[0][column], order[0][dir]
                // Laravel expects these as-is
                return d;
            }
        },
        columns: [
            { data: 0, name: 'id' },
            { data: 1, name: 'name' },
            { data: 2, name: 'latitude' },
            { data: 3, name: 'longitude' },
            { data: 4, name: 'status', sortable: false },
            { data: 5, name: 'actions', sortable: false, searchable: false }
        ],
        columnDefs: [
            {
                targets: 4,
                render: function(data) {
                    return data; // Already formatted as HTML badge in controller
                }
            },
            {
                targets: 5,
                render: function(data) {
                    return data; // Already formatted as HTML form in controller
                }
            }
        ],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        searching: true,
        ordering: true,
        language: {
            search: 'Search:',
            lengthMenu: 'Show _MENU_ records',
            info: 'Showing _START_ to _END_ of _TOTAL_ records',
            infoEmpty: 'No records',
            paginate: {
                first: 'First',
                last: 'Last',
                next: 'Next',
                previous: 'Previous'
            }
        }
    });
});
</script>
@endpush
