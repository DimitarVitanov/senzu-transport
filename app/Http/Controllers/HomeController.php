<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Single-page landing. Every section is DB-driven and editable from the
        // admin panel; the Vue components fall back to sensible defaults if a
        // record or setting is missing, so the page never breaks.
        return Inertia::render('Home', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
            'services' => Service::active()->get(),
            'featuresBar' => Feature::active()->section('hero_features')->get(),
            'steps' => Feature::active()->section('how_it_works')->get(),
            'ctaFeatures' => Feature::active()->section('why_choose')->get(),
            'testimonials' => Testimonial::active()->get(),
        ]);
    }
}
