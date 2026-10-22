<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
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
     * GET /locations (view)
     * Returns View if no DataTables params, JSON if DataTables request
     */
    public function index(Request $request): View|JsonResponse
    {
        // DataTables AJAX request (detected by 'draw' param)
        if ($request->has('draw')) {
            return $this->getDatatablesData($request);
        }

        // Normal view request
        return view('locations.index');
    }

    /**
     * Handles DataTables server-side processing
     * Returns raw JSON data for frontend rendering
     */
    private function getDatatablesData(Request $request): JsonResponse
    {
        $draw = intval($request->input('draw'));
        $start = intval($request->input('start', 0));
        $length = intval($request->input('length', 10));
        $searchValue = $request->input('search.value', '');

        // Get total records count (before filtering)
        $totalRecords = Location::count();

        // Build query with search filter
        $query = Location::query();
        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%')
                  ->orWhere('latitude', 'like', '%' . $searchValue . '%')
                  ->orWhere('longitude', 'like', '%' . $searchValue . '%')
                  ->orWhere('status', 'like', '%' . $searchValue . '%');
            });
        }

        $filteredRecords = $query->count();

        // Handle sorting
        $orderColumn = 'id';
        $orderDir = 'asc';
        
        if ($request->has('order.0.column')) {
            $colIndex = intval($request->input('order.0.column'));
            $columns = ['id', 'name', 'latitude', 'longitude', 'status', 'id'];
            
            if (isset($columns[$colIndex])) {
                $orderColumn = $columns[$colIndex];
                $orderDir = strtolower($request->input('order.0.dir')) === 'desc' ? 'desc' : 'asc';
            }
        }

        // Get paginated & sorted data
        $locations = $query->orderBy($orderColumn, $orderDir)
            ->offset($start)
            ->limit($length)
            ->get();

        // Return raw data only
        $data = $locations->map(function($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'latitude' => $location->latitude ?? '—',
                'longitude' => $location->longitude ?? '—',
                'status' => $location->status,
                'editUrl' => route('locations.edit', $location),
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
    public function destroy(Location $location): RedirectResponse
    {
        $this->locationService->destroy($location);

        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}
