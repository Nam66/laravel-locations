<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationService
{
    /**
     * Build paginated DataTables-compatible response from the index request.
     */
    public function datatable(Request $request): array
    {
        $query = Location::query();

        if ($search = $request->input('search.value')) {
            $query->search($search);
        }

        $totalRecords    = Location::count();
        $filteredRecords = $query->count();

        $columnMap   = ['id', 'name', 'latitude', 'longitude', 'status'];
        $orderColumn = (int) $request->input('order.0.column', 0);
        $orderDir    = $request->input('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';

        if (isset($columnMap[$orderColumn])) {
            $query->orderBy($columnMap[$orderColumn], $orderDir);
        }

        $start  = max(0, (int) $request->input('start', 0));
        $length = min(100, max(1, (int) $request->input('length', 10)));

        return [
            'draw'            => (int) $request->input('draw'),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $query->skip($start)->take($length)->get(),
        ];
    }

    public function store(array $data): Location
    {
        return Location::create($data);
    }

    public function update(Location $location, array $data): Location
    {
        $location->update($data);

        return $location;
    }

    public function destroy(Location $location): void
    {
        $location->delete();
    }
}
