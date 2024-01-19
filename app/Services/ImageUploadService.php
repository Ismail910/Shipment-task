<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
   
    public function uploadImage(UploadedFile $image, string $folder = 'uploads'): ?string
    {
        if ($image) {
            return $image->store($folder, 'public');
        }

        return null;
    }
}
