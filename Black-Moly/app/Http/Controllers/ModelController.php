<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = CarModel::with('brand','category')->get();
        return view('pages.model.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('pages.model.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        CarModel::create($request->all());

        return redirect() -> route('admin.models.index')->with('success','Model created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarModel $model)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('pages.model.edit',compact('model','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $model)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $model->update($request->all());
        return redirect() -> route('admin.models.index')->with('success','Model updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $model)
    {
        $model->delete();
        return redirect() -> route('admin.models.index')->with('success','Model deleted successfully');
    }
}
