<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUpload
{
    public function uploadImage(Request $request, $modelInstance)
    {
        $path = $request
            ->file('image')
            ->storeAs($this->customizeImagePath($modelInstance), $this->customizeImageFileName($request));
        return $path;
    }

    public function customizeImageFileName(Request $request)
    {
        return time().$request->file('image')->getClientOriginalName(); 
    }

    public function customizeImagePath($modelInstance)
    {
        $className = get_class($modelInstance);
        $model = explode('\\', $className)[1];
        return 'public/uploads/' . $model;
    }
}