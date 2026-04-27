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
        return Inertia::render('Home', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
            'heroFeatures' => Feature::active()->section('hero_features')->get(),
            'services' => Service::active()
                ->take(3)
                ->get(),
            'howFeatures' => Feature::active()->section('how_it_works')->get(),
            'whyFeatures' => Feature::active()->section('why_choose')->get(),
            'testimonials' => Testimonial::active()->get(),
        ]);
    }
}
