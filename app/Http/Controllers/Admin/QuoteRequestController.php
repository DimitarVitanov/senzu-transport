<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteRequestController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/QuoteRequests', [
            'quotes' => QuoteRequest::latest()->paginate(20),
        ]);
    }

    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,contacted,quoted,completed,cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $quoteRequest->update($validated);

        return back()->with('success', 'Quote request updated.');
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        $quoteRequest->delete();

        return back()->with('success', 'Quote request deleted.');
    }
}
