<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Uploads
{
    public function uploadFile(Request $request)
    {
        return $request->file('file')->store('public/uploads/files/News');
    }

    public function uploadImage(Request $request)
    {
        return $request->file('image')->store('public/uploads/images/News');
    }

    public function uploadStaffOrVisitorImage(Request $request, $modelInstance)
    {
        return $request->file('image')->store('public/uploads/images/'.explode('\\',get_class($modelInstance))[1]);
    }
}