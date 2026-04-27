<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GalleryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Gallery', [
            'images' => GalleryImage::orderBy('sort_order')->get()->map(function ($img) {
                $img->url = $img->url;
                return $img;
            }),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
            'alt_text' => 'nullable|string|max:255',
        ], [
            'images.*.required' => 'Each file is required.',
            'images.*.image' => 'The file ":input" is not a valid image.',
            'images.*.mimes' => 'Only JPG, PNG and WebP images are allowed.',
            'images.*.max' => 'Each image must be under 10MB.',
            'images.*.uploaded' => 'Upload failed — the file may be too large. Check that your server allows uploads up to 10MB (current PHP limit: ' . ini_get('upload_max_filesize') . ').',
        ]);

        $maxOrder = GalleryImage::max('sort_order') ?? 0;
        $uploaded = 0;
        $failed = [];

        foreach ($request->file('images') as $file) {
            $webpFilename = $this->convertToWebp($file);

            if ($webpFilename) {
                $maxOrder++;
                GalleryImage::create([
                    'filename' => $webpFilename,
                    'alt_text' => $request->input('alt_text', 'Senzu Transport gallery image'),
                    'sort_order' => $maxOrder,
                    'is_active' => true,
                ]);
                $uploaded++;
            } else {
                $failed[] = $file->getClientOriginalName();
            }
        }

        if ($uploaded === 0) {
            return back()->with('error', 'Upload failed — could not convert any images. Files: ' . implode(', ', $failed));
        }

        $msg = $uploaded . ' image(s) uploaded successfully.';
        if (count($failed)) {
            $msg .= ' Failed to convert: ' . implode(', ', $failed);
        }

        return back()->with('success', $msg);
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $validated = $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $galleryImage->update($validated);

        return back()->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        $path = public_path('uploads/gallery/' . $galleryImage->filename);
        if (file_exists($path)) {
            unlink($path);
        }

        $galleryImage->delete();

        return back()->with('success', 'Image deleted.');
    }

    private function convertToWebp($file): ?string
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $webpFilename = \Illuminate\Support\Str::slug($name) . '_' . time() . '.webp';
        $outputPath = public_path('uploads/gallery/' . $webpFilename);

        try {
            // Detect actual MIME type from file contents, not extension
            $mime = $file->getMimeType();
            $image = match ($mime) {
                'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
                'image/png' => imagecreatefrompng($file->getRealPath()),
                'image/gif' => imagecreatefromgif($file->getRealPath()),
                'image/webp' => imagecreatefromwebp($file->getRealPath()),
                'image/bmp' => imagecreatefrombmp($file->getRealPath()),
                default => null,
            };

            if (!$image) {
                return null;
            }

            // Preserve transparency for PNG sources
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            imagewebp($image, $outputPath, 82);
            imagedestroy($image);

            return $webpFilename;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
