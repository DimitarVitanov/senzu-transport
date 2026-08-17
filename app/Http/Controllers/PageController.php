<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\GalleryImage;
use App\Models\Service;
use App\Models\SiteSetting;
use Inertia\Inertia;

class PageController extends Controller
{
    public function services()
    {
        return Inertia::render('Services', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
            'services' => Service::active()->get(),
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
        ]);
    }

    public function gallery()
    {
        return Inertia::render('Gallery', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
            'images' => GalleryImage::active()->get()->map(function ($img) {
                $img->url = $img->url;
                return $img;
            }),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact', [
            'settings' => SiteSetting::all()->pluck('value', 'key'),
        ]);
    }
}
