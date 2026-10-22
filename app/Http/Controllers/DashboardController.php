<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('index', [
            'totalLocations'     => Location::count(),
            'activeLocations'    => Location::active()->count(),
            'pendingLocations'   => Location::byStatus(Location::STATUS_PENDING)->count(),
            'suspendedLocations' => Location::byStatus(Location::STATUS_SUSPENDED)->count(),
        ]);
    }
}
