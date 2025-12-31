<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class helpers
{
    public static function uploadImage($file, $folder)
    {
        // Folder create automatically if not exists
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        // File name generate
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // File upload
        Storage::disk('public')->put($folder . '/' . $filename, file_get_contents($file));

        // Return file path
        return $folder . '/' . $filename;
    }
}

