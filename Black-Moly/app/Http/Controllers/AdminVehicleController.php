<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminVehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderByRaw("
        FIELD(status, 'pending', 'available', 'sold')
    ")->get();

        return view('pages.vehicles.index', compact('vehicles'));
    }

    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => 'required|in:pending,available,sold',
        ]);

        $vehicle->status = $request->status;
        $vehicle->save();

        return redirect()->back()->with('success', 'Vehicle status updated successfully.');
    }
}
