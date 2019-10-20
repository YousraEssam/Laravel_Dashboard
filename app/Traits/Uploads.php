<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Uploads
{
    public function uploadFile(Request $request)
    {
        return $request->file('file')->store('public/uploads/files');
    }

    public function uploadImage(Request $request)
    {
        return $request->file('image')->store('public/uploads/images');
    }
}