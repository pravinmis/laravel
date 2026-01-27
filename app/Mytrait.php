<?php

namespace App;
use Illuminate\Support\Facades\Storage;

trait Mytrait
{
    public function hello(){
        return "hello ji";
    }



   public function uploadImage($file, $foldername, $oldImage = null)
{
    // create folder if not exists
    if (!Storage::disk('public')->exists($foldername)) {
        Storage::disk('public')->makeDirectory($foldername);
    }

    // delete old image if exists
    if ($oldImage && Storage::disk('public')->exists($oldImage)) {
        Storage::disk('public')->delete($oldImage);
    }

    // generate new filename
    $filename = time() . '.' . $file->getClientOriginalExtension();

    // save new file
    Storage::disk('public')->put($foldername . '/' . $filename, file_get_contents($file));

    return $foldername . '/' . $filename;
}

}
