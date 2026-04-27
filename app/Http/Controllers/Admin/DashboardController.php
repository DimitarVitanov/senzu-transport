<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\Service;
use App\Models\Testimonial;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_quotes' => QuoteRequest::count(),
                'new_quotes' => QuoteRequest::where('status', 'new')->count(),
                'services' => Service::count(),
                'testimonials' => Testimonial::count(),
            ],
            'recentQuotes' => QuoteRequest::latest()->take(5)->get(),
        ]);
    }
}
