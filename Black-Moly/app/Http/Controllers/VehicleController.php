<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\VehicleHistory;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        // Get all brands and categories for filters
        $brands = Brand::all();
        $categories = Category::all();

        // Build query with filters
        $query = Vehicle::with(['model.brand', 'model.category', 'images'])
            ->where('status', 'available');

        // Apply filters if provided
        if ($request->has('brand')) {
            $brandIds = $request->brand;
            $query->whereHas('model.brand', function($q) use ($brandIds) {
                $q->whereIn('brands.id', (array)$brandIds);
            });
        }

        if ($request->has('category')) {
            $categoryIds = $request->category;
            $query->whereHas('model.category', function($q) use ($categoryIds) {
                $q->whereIn('categories.id', (array)$categoryIds);
            });
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        if ($request->has('condition')) {
            $query->where('condition', $request->condition);
        }

        // Sort vehicles
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Get price ranges before applying pagination
        $minPrice = Vehicle::where('status', 'available')->min('price') ?? 0;
        $maxPrice = Vehicle::where('status', 'available')->max('price') ?? 100000;

        // Get paginated results
        $vehicles = $query->paginate(9);

        // Count total vehicles
        $totalVehicles = Vehicle::where('status', 'available')->count();

        return view('customer.pages.vehicles.index', compact('vehicles', 'brands', 'categories', 'totalVehicles', 'minPrice', 'maxPrice'));
    }

    public function show($slug)
    {
        // Find the vehicle by slug with all necessary relationships
        $vehicle = Vehicle::with([
            'model.brand',
            'model.category',
            'images',
            'history',
            'service.service'
        ])->where('slug', $slug)->firstOrFail();

        // Get related vehicles (same brand or category)
        $relatedVehicles = Vehicle::with(['model.brand', 'images'])
            ->where('id', '!=', $vehicle->id)
            ->where('status', 'available')
            ->where(function($query) use ($vehicle) {
                $query->whereHas('model', function($q) use ($vehicle) {
                    $q->where('brand_id', $vehicle->model->brand_id)
                        ->orWhere('category_id', $vehicle->model->category_id);
                });
            })
            ->limit(3)
            ->get();

        // Get vehicle colors if applicable
        $colors = $vehicle->images->pluck('image_path')->unique()->values()->all();

        return view('customer.pages.vehicles.show', compact('vehicle', 'relatedVehicles', 'colors',));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $vehicles = Vehicle::with(['model.brand', 'images'])
            ->where('status', 'active')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhereHas('model', function($mq) use ($query) {
                        $mq->where('name', 'like', "%{$query}%");
                    })
                    ->orWhereHas('model.brand', function($bq) use ($query) {
                        $bq->where('name', 'like', "%{$query}%");
                    });
            })
            ->paginate(9);

        return view('customer.pages.vehicles.index', compact('vehicles', 'query'));
    }

    public function filterByCondition($condition)
    {
        $brands = Brand::all();
        $categories = Category::all();

        $vehicles = Vehicle::with(['model.brand', 'images'])
            ->where('status', 'active')
            ->where('condition', $condition)
            ->paginate(9);

        $totalVehicles = Vehicle::where('status', 'active')
            ->where('condition', $condition)
            ->count();

        return view('customer.pages.vehicles.index', compact('vehicles', 'brands', 'categories', 'totalVehicles', 'condition'));
    }

    public function compare(Request $request)
    {
        $vehicleIds = $request->get('vehicles', []);

        $vehicles = Vehicle::with(['model.brand', 'images'])
            ->whereIn('id', $vehicleIds)
            ->get();

        return view('customer.pages.vehicles.compare', compact('vehicles'));
    }

    public function create(){
        $carModels = CarModel::all();
        return view('customer.pages.vehicles.create', compact('carModels'));
    }

    public function edit($id)
    {
        try {
            // Find the vehicle
            $vehicle = Vehicle::findOrFail($id);

            // Check if user owns this vehicle
            if (Auth::id() !== $vehicle->user_id) {
                return redirect()->route('profile.index', ['tab' => 'vehicles'])->with('error', 'You are not authorized to edit this vehicle.');
            }

            // Get vehicle history
            $vehicleHistory = VehicleHistory::where('vehicle_id', $vehicle->id)->first();

            // Get car models for dropdown
            $carModels = CarModel::all();

            return view('customer.pages.vehicles.edit', compact('vehicle', 'vehicleHistory', 'carModels'));
        } catch (\Exception $e) {
            return redirect()->route('profile.index', ['tab' => 'vehicles'])->with('error', 'Vehicle not found.');
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used,pre-owned',
            'transmission' => 'required|in:auto,manual',
            'fuel_type' => 'required|in:diesel,petrol,electric',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'accidents' => 'nullable|integer|min:0',
            'ownership_count' => 'nullable|integer|min:0',
            'has_flood_damage' => 'nullable|boolean',
            'has_salvage_title' => 'nullable|boolean',
            'services' => 'nullable|array',
            'services.*' => 'nullable|date',
            'last_service' => 'nullable|date',
            'next_service_due' => 'nullable|date',
            'history_notes' => 'nullable|string',
            'car_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_image' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            Log::info('Starting vehicle creation process', ['user_id' => auth()->id(), 'data' => $validatedData]);

            // Create slug from vehicle name
            $slug = Str::slug($validatedData['name']);
            $baseSlug = $slug;
            $counter = 1;
            while (Vehicle::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Save vehicle
            $vehicle = new Vehicle();
            $vehicle->title = $validatedData['name'];
            $vehicle->slug = $slug;
            $vehicle->year = $validatedData['year'];
            $vehicle->price = $validatedData['price'];
            $vehicle->mileage = $validatedData['mileage'];
            $vehicle->fuel_type = $validatedData['fuel_type'];
            $vehicle->transmission = $validatedData['transmission'];
            $vehicle->condition = $validatedData['condition'];
            $vehicle->location = $validatedData['location'];
            $vehicle->description = $validatedData['description'] ?? null;
            $vehicle->status = 'pending';
            $vehicle->model_id = $validatedData['model_id'];
            $vehicle->user_id = auth()->id();
            $vehicle->save();

            Log::info('Vehicle created successfully', ['vehicle_id' => $vehicle->id]);

            // Save vehicle history
            $vehicleHistory = new VehicleHistory();
            $vehicleHistory->vehicle_id = $vehicle->id;
            $vehicleHistory->accidents = $validatedData['accidents'] ?? 0;
            $vehicleHistory->ownership_count = $validatedData['ownership_count'] ?? 1;
            $vehicleHistory->has_flood_damage = $validatedData['has_flood_damage'] ?? false;
            $vehicleHistory->has_salvage_title = $validatedData['has_salvage_title'] ?? false;

            // Format service records in the new structure
            $serviceRecordsData = [
                'services' => [],
            ];

            // Add individual services to the services object
            if (!empty($validatedData['services'])) {
                $serviceRecordsData['services'] = $validatedData['services'];
            }

            // Add last service and next service due dates outside the services object
            if (!empty($validatedData['last_service'])) {
                $serviceRecordsData['last_service'] = $validatedData['last_service'];
            }

            if (!empty($validatedData['next_service_due'])) {
                $serviceRecordsData['next_service_due'] = $validatedData['next_service_due'];
            }

            $vehicleHistory->service_records = !empty($serviceRecordsData['services']) ||
            !empty($serviceRecordsData['last_service']) ||
            !empty($serviceRecordsData['next_service_due'])
                ? json_encode($serviceRecordsData)
                : null;

            Log::info('Service records saved', ['records' => $serviceRecordsData]);

            $vehicleHistory->notes = $validatedData['history_notes'] ?? null;
            $vehicleHistory->save();

            // Upload images
            if ($request->hasFile('car_images')) {
                $primaryImageIndex = $request->input('primary_image');
                $files = $request->file('car_images');

                // Get model name for filename
                $modelName = DB::table('models')->where('id', $vehicle->model_id)->value('name');
                $modelSlug = Str::slug($modelName);

                foreach ($files as $index => $file) {
                    // Create descriptive filename: model-name-year-index.extension
                    $filename = $modelSlug . '-' . $vehicle->year . '-' . ($index + 1) . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('images/vehicles', $filename, 'public');

                    $image = new VehicleImage();
                    $image->image_path = 'images/vehicles/' . $filename;
                    $image->is_primary = ($primaryImageIndex !== null && (int)$primaryImageIndex === $index);
                    $image->vehicle_id = $vehicle->id;
                    $image->save();

                    Log::info('Image uploaded', ['image' => $image->image_path, 'is_primary' => $image->is_primary]);
                }

                // Fallback to first image as primary if none was selected
                if ($primaryImageIndex === null && count($files) > 0) {
                    $firstImage = VehicleImage::where('vehicle_id', $vehicle->id)->first();
                    if ($firstImage) {
                        $firstImage->is_primary = true;
                        $firstImage->save();
                        Log::info('Default primary image set', ['image_id' => $firstImage->id]);
                    }
                }
            }

            DB::commit();

            Log::info('Vehicle listing completed successfully', ['vehicle_id' => $vehicle->id]);
            return redirect()->route('home')->with('success', 'Your vehicle has been listed successfully and is pending approval.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Vehicle listing failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Failed to list your vehicle. ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used,pre-owned',
            'transmission' => 'required|in:auto,manual',
            'fuel_type' => 'required|in:diesel,petrol,electric',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'accidents' => 'nullable|integer|min:0',
            'ownership_count' => 'nullable|integer|min:0',
            'has_flood_damage' => 'nullable|boolean',
            'has_salvage_title' => 'nullable|boolean',
            'services' => 'nullable|array',
            'services.*' => 'nullable|date',
            'last_service' => 'nullable|date',
            'next_service_due' => 'nullable|date',
            'history_notes' => 'nullable|string',
            'car_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_image_new' => 'nullable|integer|min:0',
            'primary_image_existing' => 'nullable|integer|exists:vehicle_images,id',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:vehicle_images,id',
        ]);

        try {
            // Find the vehicle
            $vehicle = Vehicle::findOrFail($id);

            // Check if user owns this vehicle
            if (Auth::id() !== $vehicle->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to update this vehicle.');
            }

            DB::beginTransaction();

            Log::info('Starting vehicle update process', ['vehicle_id' => $id, 'user_id' => auth()->id()]);

            // Update slug if title changed
            if ($vehicle->title !== $validatedData['name']) {
                $slug = Str::slug($validatedData['name']);
                $baseSlug = $slug;
                $counter = 1;

                // Make sure slug is unique
                while (Vehicle::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                $vehicle->slug = $slug;
            }

            // Update vehicle data
            $vehicle->title = $validatedData['name'];
            $vehicle->year = $validatedData['year'];
            $vehicle->price = $validatedData['price'];
            $vehicle->mileage = $validatedData['mileage'];
            $vehicle->fuel_type = $validatedData['fuel_type'];
            $vehicle->transmission = $validatedData['transmission'];
            $vehicle->condition = $validatedData['condition'];
            $vehicle->location = $validatedData['location'];
            $vehicle->description = $validatedData['description'] ?? null;
            $vehicle->model_id = $validatedData['model_id'];
            $vehicle->save();

            Log::info('Vehicle updated successfully', ['vehicle_id' => $vehicle->id]);

            // Update or create vehicle history
            $vehicleHistory = VehicleHistory::firstOrNew(['vehicle_id' => $vehicle->id]);
            $vehicleHistory->accidents = $validatedData['accidents'] ?? 0;
            $vehicleHistory->ownership_count = $validatedData['ownership_count'] ?? 1;
            $vehicleHistory->has_flood_damage = $validatedData['has_flood_damage'] ?? false;
            $vehicleHistory->has_salvage_title = $validatedData['has_salvage_title'] ?? false;

            // Format service records in the new structure
            $serviceRecordsData = [
                'services' => [],
            ];

            // Add individual services to the services object
            if (!empty($validatedData['services'])) {
                $serviceRecordsData['services'] = $validatedData['services'];
            }

            // Add last service and next service due dates outside the services object
            if (!empty($validatedData['last_service'])) {
                $serviceRecordsData['last_service'] = $validatedData['last_service'];
            }

            if (!empty($validatedData['next_service_due'])) {
                $serviceRecordsData['next_service_due'] = $validatedData['next_service_due'];
            }

            $vehicleHistory->service_records = !empty($serviceRecordsData['services']) ||
            !empty($serviceRecordsData['last_service']) ||
            !empty($serviceRecordsData['next_service_due'])
                ? json_encode($serviceRecordsData)
                : null;

            $vehicleHistory->notes = $validatedData['history_notes'] ?? null;
            $vehicleHistory->save();

            Log::info('Vehicle history updated', ['vehicle_history_id' => $vehicleHistory->id]);

            // Handle image deletion if any
            if (!empty($validatedData['delete_images'])) {
                foreach ($validatedData['delete_images'] as $imageId) {
                    $image = VehicleImage::where('id', $imageId)
                        ->where('vehicle_id', $vehicle->id)
                        ->first();

                    if ($image) {
                        // Delete physical file
                        if (file_exists(public_path('storage/' . $image->image_path))) {
                            unlink(public_path('storage/' . $image->image_path));
                        }
                        $image->delete();
                        Log::info('Deleted image', ['image_id' => $imageId]);
                    }
                }
            }

            // Set primary image from existing images
            if (!empty($validatedData['primary_image_existing'])) {
                // Reset all images to non-primary
                VehicleImage::where('vehicle_id', $vehicle->id)
                    ->update(['is_primary' => false]);

                // Set the selected image as primary
                VehicleImage::where('id', $validatedData['primary_image_existing'])
                    ->where('vehicle_id', $vehicle->id)
                    ->update(['is_primary' => true]);

                Log::info('Updated primary image', ['image_id' => $validatedData['primary_image_existing']]);
            }

            // Upload new images if any
            if ($request->hasFile('car_images')) {
                $primaryImageIndex = $request->input('primary_image_new');
                $files = $request->file('car_images');

                // Get model name for filename
                $modelName = DB::table('models')->where('id', $vehicle->model_id)->value('name');
                $modelSlug = Str::slug($modelName);

                foreach ($files as $index => $file) {
                    // Create descriptive filename
                    $filename = $modelSlug . '-' . $vehicle->year . '-' . time() . '-' . ($index + 1) . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('images/vehicles', $filename, 'public');

                    $image = new VehicleImage();
                    $image->image_path = 'images/vehicles/' . $filename;

                    // Set as primary if selected AND no existing primary was selected
                    $isPrimary = ($primaryImageIndex !== null && (int)$primaryImageIndex === $index && empty($validatedData['primary_image_existing']));

                    // If this is primary, reset all other images
                    if ($isPrimary) {
                        VehicleImage::where('vehicle_id', $vehicle->id)
                            ->update(['is_primary' => false]);
                    }

                    $image->is_primary = $isPrimary;
                    $image->vehicle_id = $vehicle->id;
                    $image->save();

                    Log::info('New image uploaded', ['image' => $image->image_path, 'is_primary' => $image->is_primary]);
                }
            }

            // If no primary image exists, set the first image as primary
            $hasPrimary = VehicleImage::where('vehicle_id', $vehicle->id)
                ->where('is_primary', true)
                ->exists();

            if (!$hasPrimary) {
                $firstImage = VehicleImage::where('vehicle_id', $vehicle->id)->first();
                if ($firstImage) {
                    $firstImage->is_primary = true;
                    $firstImage->save();
                    Log::info('Set default primary image', ['image_id' => $firstImage->id]);
                }
            }

            DB::commit();

            return redirect()->route('profile.index', ['tab' => 'vehicles'])->with('success', 'Vehicle updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Vehicle update failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Failed to update vehicle: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Find the vehicle
            $vehicle = Vehicle::findOrFail($id);

            // Check if user owns this vehicle
            if (Auth::id() !== $vehicle->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to delete this vehicle.');
            }

            // Begin transaction to ensure data integrity
            DB::beginTransaction();

            // Delete associated images
            $images = VehicleImage::where('vehicle_id', $vehicle->id)->get();

            foreach ($images as $image) {
                // Delete the physical file
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }

                // Delete the database record
                $image->delete();
            }

            // Delete associated vehicle history
            VehicleHistory::where('vehicle_id', $vehicle->id)->delete();

            // Delete the vehicle
            $vehicle->delete();

            // Commit transaction
            DB::commit();

            return redirect()->route('profile.index', ['tab' => 'vehicles'])->with('success', 'Vehicle has been deleted successfully.');

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}
