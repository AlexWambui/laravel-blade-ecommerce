<?php

namespace App\Http\Controllers\Deliveries;

use App\Http\Controllers\Controller;
use App\Models\Deliveries\DeliveryArea;
use App\Models\Deliveries\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    public function index()
    {
        $locations = DeliveryLocation::with('areas')->orderBy('name')->get();
        $areas = DeliveryArea::orderBy('name')->get();
        $count_areas = $areas->count();
        
        return view('admin.deliveries.areas.index', compact('areas', 'count_areas', 'locations'));
    }

    public function create()
    {
        $locations = DeliveryLocation::all();

        return view('admin.deliveries.areas.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated_area = $request->validate([
            'name' => 'required|string|max:100|unique:delivery_areas,name',
            'price' => 'required|numeric',
            'delivery_location_id' => 'required',
        ]);

        DeliveryArea::create($validated_area);

        return redirect()->route('areas.index')->with('success', 'Delivery area has been added.');
    }

    public function edit(DeliveryArea $area)
    {
        $locations = DeliveryLocation::all();
        
        return view('admin.deliveries.areas.edit', compact('locations', 'area'));
    }

    public function update(Request $request, DeliveryArea $area)
    {
        $validated_area = $request->validate([
            'name' => 'required|string|max:100|unique:delivery_areas,name,' . $area->id,
            'price' => 'required|numeric',
            'delivery_location_id' => 'required',
        ]);

        $area->update($validated_area);

        return redirect()->route('areas.index')->with('success', 'Delivery area has been updated.');
    }

    public function destroy(DeliveryArea $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Delivery area has been deleted.');
    }

    public function getAreas($locationId)
    {
        $areas = DeliveryArea::where('delivery_location_id', $locationId)->get();
        return response()->json($areas);
    }

    public function getShippingPrice($areaId)
    {
        $area = DeliveryArea::findOrFail($areaId);
        $price = $area->price;

        return response()->json(['price' => $price]);
    }
}
