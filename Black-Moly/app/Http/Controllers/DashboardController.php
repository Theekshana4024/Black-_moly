<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all brands, categories, and models for dropdowns
        $brands = Brand::all();
        $categories = Category::all();
        $models = CarModel::all();

        // Get featured vehicles with their primary images
        $featuredVehicles = Vehicle::with(['model.brand', 'images'])
            ->where('status', 'available')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($vehicle) {
                // Filter to only primary image or fallback to first image
                $primaryImage = $vehicle->images->where('is_primary', true)->first()
                    ?? $vehicle->images->first();

                // Optionally set a new attribute
                $vehicle->primary_image = $primaryImage;
                return $vehicle;
            });


        return view('customer.pages.home', compact('brands', 'categories', 'models', 'featuredVehicles'));
    }

    public function searchVehicles(Request $request)
    {
        $query = Vehicle::query();

        if ($request->filled('brand')) {
            $query->whereHas('model.brand', function($q) use ($request) {
                $q->where('id', $request->brand);
            });
        }

        if ($request->filled('model')) {
            $query->where('model_id', $request->model);
        }

        if ($request->filled('category')) {
            $query->whereHas('model', function($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $vehicles = $query->with(['model.brand', 'images' => function($query) {
            $query->where('is_primary', true)->orWhereRaw('id = (SELECT MIN(id) FROM vehicle_images WHERE vehicle_id = vehicles.id)');
        }])->paginate(12);

        return view('customer.pages.vehicles.index', compact('vehicles'));
    }
}

