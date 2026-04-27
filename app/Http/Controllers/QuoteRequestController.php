<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'job_details' => 'required|string|max:2000',
            'suburb' => 'required|string|max:255',
        ]);

        QuoteRequest::create($validated);

        return back()->with('success', 'Quote request submitted successfully! We will contact you shortly.');
    }
}
