@extends('layouts.app')

@section('title', 'Locations')
@section('page-title', 'Locations')

@section('content')

<!-- Content area -->
<div class="content">

    <!-- Locations table -->
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">Locations List</h5>
            <a href="{{ route('locations.create') }}" class="btn btn-primary ms-auto">
                <i class="ph-plus me-2"></i>
                Add Location
            </a>
        </div>

        <div class="card-body">
            Manage all your location data with server-side processing for efficient data handling.
        </div>

        <table class="table datatable-ajax">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /locations table -->

</div>
<!-- /content area -->

@endsection

@push('scripts')
<script>
// Status configuration
const statusConfig = {
    active: {
        badge: 'bg-teal',
        icon: 'ph-check-circle',
        label: 'Active'
    },
    pending: {
        badge: 'bg-orange',
        icon: 'ph-hourglass',
        label: 'Pending'
    },
    suspended: {
        badge: 'bg-danger',
        icon: 'ph-x-circle',
        label: 'Suspended'
    }
};

// Delete location function
window.deleteLocation = function(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/locations/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Render status badge
function renderStatusBadge(status) {
    const config = statusConfig[status] || {
        badge: 'bg-secondary',
        icon: 'ph-question',
        label: 'Unknown'
    };
    
    return `<span class="badge ${config.badge}">
        <i class="${config.icon} me-1"></i>${config.label}
    </span>`;
}

// Render action buttons
function renderActions(row) {
    return `<a href="#" class="text-body" data-bs-toggle="dropdown">
        <i class="ph-list"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a href="${row.editUrl}" class="dropdown-item">
            <i class="ph-pencil me-2"></i>
            Edit
        </a>
        <button type="button" class="dropdown-item text-danger" onclick="deleteLocation(${row.id}, '${row.name.replace(/'/g, "\\'")}')">
            <i class="ph-trash me-2"></i>
            Delete
        </button>
    </div>`;
}

// Initialize Locations DataTable
$(document).ready(function() {
    $('.datatable-ajax').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: '/locations',
            type: 'GET'
        },
        columns: [
            { 
                data: 'name',
                render: function(data, type, row) {
                    return `<a href="${row.editUrl}" class="fw-semibold">${data}</a>`;
                }
            },
            { 
                data: 'latitude',
                searchable: false,
                className: 'text-muted'
            },
            { 
                data: 'longitude',
                searchable: false,
                className: 'text-muted'
            },
            { 
                data: 'status',
                searchable: false,
                orderable: false,
                render: function(data) {
                    return renderStatusBadge(data);
                }
            },
            { 
                data: 'id',
                searchable: false,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `<div class="dropdown">${renderActions(row)}</div>`;
                }
            }
        ],
        order: [[0, 'asc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            infoEmpty: 'Showing 0 to 0 of 0 entries',
            paginate: {
                first: '<i class="ph-caret-double-left"></i>',
                last: '<i class="ph-caret-double-right"></i>',
                next: '<i class="ph-caret-right"></i>',
                previous: '<i class="ph-caret-left"></i>'
            }
        },
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        initComplete: function() {
            $('.dataTables_length select').addClass('form-select form-select-sm');
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_filter input').attr('placeholder', 'Type to filter...');
        }
    });
});
</script>
@endpush
