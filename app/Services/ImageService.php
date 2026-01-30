<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function squareAndResize(UploadedFile $file, string $directory, string $filename = 'image.webp', int $size = 512, ?string $deletePath = null): string {
        //DELETE PREVIOUS IMAGE
        if ($deletePath && Storage::disk('public')->exists($deletePath))
            Storage::disk('public')->delete($deletePath);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $width  = $image->width();
        $height = $image->height();
        $cropSize = min($width, $height);

        //CENTERED SQUARE CROP
        $image->crop($cropSize, $cropSize, intval(($width-$cropSize) / 2), intval(($height-$cropSize)/2));

        //RESIZE
        $image->resize($size, $size);

        $path = "{$directory}/{$filename}";

        //OPTIMIZE AND SAVE
        Storage::disk('public')->put($path, (string) $image->toWebp(85));

        return $path;
    }
}