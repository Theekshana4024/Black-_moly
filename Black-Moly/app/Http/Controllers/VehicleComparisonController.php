<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleComparisonController extends Controller
{
    public function index()
    {
        // Get only available vehicles
        $availableVehicles = Vehicle::where('status', 'available')->get();

        return view('customer.pages.vehicles.compare', compact('availableVehicles'));
    }

    public function compareVehicles($vehicle1Id, $vehicle2Id)
    {
        $vehicle1 = Vehicle::with('history')->findOrFail($vehicle1Id);
        $vehicle2 = Vehicle::with('history')->findOrFail($vehicle2Id);

        // Make sure both vehicles are available
        if ($vehicle1->status !== 'available' || $vehicle2->status !== 'available') {
            return redirect()->route('compare.index')
                ->with('error', 'One of the selected vehicles is no longer available');
        }

        // Get all available vehicles for dropdown options
        $availableVehicles = Vehicle::where('status', 'available')->get();

        // Save this comparison to history if user is logged in
        if (Auth::check()) {
            VehicleComparison::create([
                'user_id' => Auth::id(),
                'vehicle_compared' => json_encode([$vehicle1Id, $vehicle2Id])
            ]);
        }

        return view('customer.pages.vehicles.compare', compact('vehicle1', 'vehicle2', 'availableVehicles'));
    }

    public function reset($position = null)
    {
        if ($position) {
            // Reset specific position and redirect back with remaining selection
            if ($position == 1 && session()->has('vehicle2_id')) {
                $vehicle2Id = session('vehicle2_id');
                session()->forget(['vehicle1_id', 'vehicle2_id']);
                return redirect()->route('compare.select', ['vehicleId' => $vehicle2Id, 'position' => 1]);
            } elseif ($position == 2 && session()->has('vehicle1_id')) {
                $vehicle1Id = session('vehicle1_id');
                session()->forget(['vehicle1_id', 'vehicle2_id']);
                return redirect()->route('compare.select', ['vehicleId' => $vehicle1Id, 'position' => 1]);
            }
        }

        // Reset all selections
        session()->forget(['vehicle1_id', 'vehicle2_id']);
        return redirect()->route('compare.index');
    }

    public function selectVehicle($vehicleId, $position)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Make sure the vehicle is available
        if ($vehicle->status !== 'available') {
            return redirect()->route('compare.index')
                ->with('error', 'Selected vehicle is no longer available');
        }

        // Store in session based on position
        if ($position == 1) {
            session(['vehicle1_id' => $vehicleId]);

            // If both vehicles are selected, redirect to comparison
            if (session()->has('vehicle2_id')) {
                return redirect()->route('compare.vehicles', [
                    'vehicle1Id' => $vehicleId,
                    'vehicle2Id' => session('vehicle2_id')
                ]);
            }
        } else {
            session(['vehicle2_id' => $vehicleId]);

            // If both vehicles are selected, redirect to comparison
            if (session()->has('vehicle1_id')) {
                return redirect()->route('compare.vehicles', [
                    'vehicle1Id' => session('vehicle1_id'),
                    'vehicle2Id' => $vehicleId
                ]);
            }
        }

        // Return to compare page with selection
        return redirect()->route('compare.index');
    }
}
