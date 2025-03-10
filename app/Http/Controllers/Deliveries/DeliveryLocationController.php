<?php

namespace App\Http\Controllers\Deliveries;

use App\Http\Controllers\Controller;
use App\Models\Deliveries\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    public function index()
    {
        $locations = DeliveryLocation::with('areas')->latest()->get();
        $count_locations = $locations->count();

        return view('admin.deliveries.locations.index', compact('count_locations', 'locations'));
    }

    public function create()
    {
        return view('admin.deliveries.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:delivery_locations,name',
        ]);

        DeliveryLocation::create($request->only('name'));

        return redirect()->route('locations.index')->with('success', 'Location has been added.');
    }

    public function edit(DeliveryLocation $location)
    {
        return view('admin.deliveries.locations.edit', compact('location'));
    }

    public function update(Request $request, DeliveryLocation $location)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:delivery_locations,name,' . $location->id,
        ]);

        $location->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('locations.index')->with('success', 'Location has been updated.');
    }

    public function destroy(DeliveryLocation $location)
    {
        $location->delete();
        
        return redirect()->route('locations.index')->with('success', 'Location and associated areas have been deleted.');
    }
}
