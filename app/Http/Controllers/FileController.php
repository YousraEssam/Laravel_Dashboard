<?php

namespace App\Http\Controllers;

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
        $id = $this->uploadFile($request);
        return response()->json(['id' => $id]);
    }
}
