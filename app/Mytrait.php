<?php

namespace App;

trait Mytrait
{
    public function hello(){
        return "hello ji";
    }



    public function uploadImage($file, $foldername){

        if(!Storage::disk('public')->exists($foldername)){
            Storage::disk('public')->makeDirectory($foldername);
        }

        $filename = time().'.'.$file->getClientOriginalExtension();

          storage::disk('public')->put($folder.'/'.$filename,file_get_content($file));
        
          return $foldername.'/'.$filename;
    }
}
