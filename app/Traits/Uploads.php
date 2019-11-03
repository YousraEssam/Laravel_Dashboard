<?php

namespace App\Traits;

use App\File;
use App\Image;
use App\Video;
use Illuminate\Http\Request;

trait Uploads
{
    public function uploadFileDb(Request $request)
    {
        $path = $request->file('file')->store('public/uploads/files');
        $file = File::create(['file_url' => $path]);
        return $file->id;
    }

    public function uploadImageDb(Request $request)
    {
        $path = $request->file('image')->store('public/uploads/images');
        $image = Image::create(['url' => $path]);
        return $image->id;
    }

    public function uploadImage(Request $request)
    {
        return $request->file('image')->store('public/uploads/images');
    }
    
    public function uploadFile(Request $request)
    {
        return $request->file('file')->store('public/uploads/files');
    }
    
    public function uploadVideo(Request $request)
    {
        return $request->file('video')->store('public/uploads/videos');
    }
}