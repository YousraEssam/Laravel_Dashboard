<?php

namespace App\Http\Controllers;

use App\File;
use App\Traits\Uploads;
use Illuminate\Http\Request;

class FileController extends Controller
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
        $path = $this->uploadFile($request);
        return response()->json(['name' => $path]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\File                $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

}
