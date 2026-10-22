<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function __construct(
        private readonly LocationService $locationService,
    ) {}

    /**
     * GET /locations
     * - Normal request  → return list view
     * - AJAX/JSON request → return DataTables JSON for AJAX
     */
    public function index(Request $request): View|JsonResponse
    {
        // Handle DataTables AJAX request
        if ($request->expectsJson() || $request->has('draw')) {
            return $this->datatable($request);
        }

        // Normal page load - just return view (data loaded via AJAX)
        return view('locations.index');
    }

    /**
     * Handle DataTables AJAX request
     * GET /locations?draw=1&start=0&length=10&search[value]=...&order[0][column]=0&order[0][dir]=asc
     */
    private function datatable(Request $request): JsonResponse
    {
        $draw = intval($request->input('draw'));
        $start = intval($request->input('start', 0));
        $length = intval($request->input('length', 10));
        $searchValue = $request->input('search.value', '');
        
        // Get total records count
        $totalRecords = Location::count();

        // Build query with search
        $query = Location::query();
        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%')
                  ->orWhere('status', 'like', '%' . $searchValue . '%');
            });
        }

        $filteredRecords = $query->count();

        // Handle sorting
        $orderColumn = 'id';
        $orderDir = 'asc';
        
        if ($request->has('order.0.column')) {
            $colIndex = intval($request->input('order.0.column'));
            $columns = ['id', 'name', 'latitude', 'longitude', 'status', 'created_at'];
            if (isset($columns[$colIndex])) {
                $orderColumn = $columns[$colIndex];
                $orderDir = $request->input('order.0.dir') === 'desc' ? 'desc' : 'asc';
            }
        }

        // Get paginated data
        $locations = $query->orderBy($orderColumn, $orderDir)
            ->offset($start)
            ->limit($length)
            ->get();

        // Format data for DataTables
        $data = $locations->map(function($location) {
            $badgeClass = match($location->status) {
                'active' => 'bg-success',
                'pending' => 'bg-warning text-dark',
                'suspended' => 'bg-danger',
                default => 'bg-secondary',
            };
            $icons = [
                'active' => 'ph-check-circle',
                'pending' => 'ph-hourglass',
                'suspended' => 'ph-x-circle',
            ];
            
            $statusBadge = '<span class="badge ' . $badgeClass . '">'
                . '<i class="' . ($icons[$location->status] ?? 'ph-question') . ' me-1"></i>'
                . ucfirst($location->status)
                . '</span>';

            $actions = '<div class="d-flex justify-content-center gap-1">'
                . '<a href="' . route('locations.edit', $location) . '" class="btn btn-xs btn-outline-primary" style="padding: 2px 8px; font-size: 11px" title="Edit">'
                . '<i class="ph-pencil"></i></a>'
                . '<form action="' . route('locations.destroy', $location) . '" method="POST" style="display: inline;" onsubmit="return confirm(\'Delete ' . $location->name . '?\');">'
                . csrf_field()
                . method_field('DELETE')
                . '<button type="submit" class="btn btn-xs btn-outline-danger" style="padding: 2px 8px; font-size: 11px" title="Delete">'
                . '<i class="ph-trash"></i></button></form></div>';

            return [
                $location->id,
                $location->name,
                $location->latitude ?? '—',
                $location->longitude ?? '—',
                $statusBadge,
                $actions,
            ];
        })->toArray();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }

    /**
     * GET /locations/create
     */
    public function create(): View
    {
        return view('locations.create', [
            'statuses' => Location::STATUSES,
        ]);
    }

    /**
     * POST /locations
     */
    public function store(StoreLocationRequest $request): RedirectResponse
    {
        $this->locationService->store($request->validated());

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    /**
     * GET /locations/{location}/edit
     */
    public function edit(Location $location): View
    {
        return view('locations.edit', [
            'location' => $location,
            'statuses' => Location::STATUSES,
        ]);
    }

    /**
     * PUT /locations/{location}
     */
    public function update(UpdateLocationRequest $request, Location $location): RedirectResponse
    {
        $this->locationService->update($location, $request->validated());

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * DELETE /locations/{location}
     */
    public function destroy(Location $location): JsonResponse
    {
        $this->locationService->destroy($location);

        return response()->json(['message' => 'Location deleted successfully.']);
    }
}
