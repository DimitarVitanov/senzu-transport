<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeatureController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Features', [
            'features' => Feature::orderBy('section')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'section' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        Feature::create($validated);

        return back()->with('success', 'Feature created.');
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'section' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $feature->update($validated);

        return back()->with('success', 'Feature updated.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return back()->with('success', 'Feature deleted.');
    }
}
