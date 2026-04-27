<?php

namespace App\Console\Commands;

use App\Models\GalleryImage;
use Illuminate\Console\Command;

class ConvertGalleryToWebp extends Command
{
    protected $signature = 'gallery:convert-webp';
    protected $description = 'Convert existing gallery images to WebP format';

    public function handle(): int
    {
        $galleryPath = public_path('uploads/gallery');
        $images = GalleryImage::all();
        $converted = 0;

        foreach ($images as $img) {
            $oldPath = $galleryPath . '/' . $img->filename;

            if (!file_exists($oldPath)) {
                $this->warn("SKIP (missing): {$img->filename}");
                continue;
            }

            $ext = strtolower(pathinfo($img->filename, PATHINFO_EXTENSION));

            if ($ext === 'webp') {
                $this->info("SKIP (already webp): {$img->filename}");
                continue;
            }

            $name = pathinfo($img->filename, PATHINFO_FILENAME);
            $webpFilename = $name . '.webp';
            $webpPath = $galleryPath . '/' . $webpFilename;

            // Detect actual image type from file contents, not extension
            $mime = mime_content_type($oldPath);
            $source = null;
            if (in_array($mime, ['image/jpeg', 'image/jpg'])) {
                $source = imagecreatefromjpeg($oldPath);
            } elseif ($mime === 'image/png') {
                $source = imagecreatefrompng($oldPath);
            } elseif ($mime === 'image/gif') {
                $source = imagecreatefromgif($oldPath);
            } elseif ($mime === 'image/webp') {
                $source = imagecreatefromwebp($oldPath);
            }

            if (!$source) {
                $this->warn("SKIP (unsupported): {$img->filename}");
                continue;
            }

            imagepalettetotruecolor($source);
            imagealphablending($source, true);
            imagesavealpha($source, true);
            imagewebp($source, $webpPath, 82);
            imagedestroy($source);

            unlink($oldPath);

            $img->update(['filename' => $webpFilename]);
            $this->info("Converted: {$img->filename}");
            $converted++;
        }

        $this->info("Done. Converted {$converted} images.");

        return 0;
    }
}
