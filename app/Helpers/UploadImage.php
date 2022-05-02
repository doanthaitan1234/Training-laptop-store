<?php
namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadImage {

    public function uploads($file, $relation_id)
    {
        if($file) {
            $name   = time() . $file->getClientOriginalName();
            Storage::disk('public')->put($type . '/' . $name, File::get($file));
            $path   = 'storage/' . $type . '/' . $name;
            $type = $file->getClientOriginalExtension();

            return $file = [
                'name' => $name,
                'relation_id' => $relation_id,
                'type' => $type,
                'path' => $path,
            ];
        }
    }
}
