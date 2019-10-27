<?php

namespace App\Traits;

use App\File;
use App\Image;
use Illuminate\Http\Request;

trait Uploads
{
    public function uploadFile(Request $request)
    {
        $path = $request->file('file')->store('public/uploads/files');
        $file = File::create(['file_url' => $path]);
        return $file->id;
    }

    public function uploadImage(Request $request)
    {
        $path = $request->file('image')->store('public/uploads/images');
        $image = Image::create(['url' => $path]);
        return $image->id;
    }
}