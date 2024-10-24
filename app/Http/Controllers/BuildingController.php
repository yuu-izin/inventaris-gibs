<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('pages.building.index', compact('buildings'));
    }

    public function create()
    {
        return view('pages.building.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $building = new Building();
        $building->name = $request->name;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/buildings'), $imageName);
            $building->image = $imageName;
        }

        $building->save();

        // Ganti 'building.index' dengan 'inventaris.index'
        return redirect()->route('inventaris.index')
            ->with('success', 'Building added successfully.');
    }

    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('pages.building.edit', compact('building'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $building = Building::findOrFail($id);
        $building->name = $request->name;

        // Jika ada gambar baru, hapus gambar lama dan simpan gambar baru
        if ($request->hasFile('image')) {
            if ($building->image) {
                $oldImagePath = public_path('images/buildings/' . $building->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/buildings'), $imageName);
            $building->image = $imageName;
        }

        $building->save();

        return redirect()->route('building.index')->with('success', 'Building updated successfully.');
    }

    public function destroy($id)
    {
        $building = Building::findOrFail($id);

        // Hapus gambar jika ada
        if ($building->image) {
            $imagePath = public_path('images/buildings/' . $building->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $building->delete();

        return redirect()->route('building.index')->with('success', 'Building deleted successfully.');
    }
}
