<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = Officer::all();
        return view('pages.officer.index', compact('officers'));
    }

    public function create()
    {
        return view('pages.officer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:officers',
        ]);

        Officer::create($request->all());

        return redirect()->route('officer.index')->with('success', 'Officer created successfully.');
    }

    public function show(Officer $officer)
    {
        return view('pages.officer.show', compact('officer'));
    }

    public function edit(Officer $officer)
    {
        return view('pages.officer.edit', compact('officer'));
    }

    public function update(Request $request, Officer $officer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:officers,email,' . $officer->id,
        ]);

        $officer->update($request->all());

        return redirect()->route('officer.index')->with('success', 'Officer updated successfully.');
    }

    public function destroy(Officer $officer)
    {
        $officer->delete();

        return redirect()->route('officer.index')->with('success', 'Officer deleted successfully.');
    }
}
