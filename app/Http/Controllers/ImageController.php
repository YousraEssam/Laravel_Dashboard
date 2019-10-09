<?php

namespace App\Http\Controllers;

use App\Image;
use App\Traits\Uploads;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use Uploads;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $this->uploadImage($request);
        return response()->json(['name' => $path]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Image               $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

}
