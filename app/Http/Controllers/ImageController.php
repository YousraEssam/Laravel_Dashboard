<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\ImageRequest;
use App\Image;
use App\Traits\Uploads;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use Uploads;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {
        return view('library.files.images.create', compact('folder'));
    }

    /**
     * Store a newly created resource in server using trait. [Ajax Request]
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $this->uploadImage($request);
        return response()->json(['id' => $id]);
    }

    /**
     * Store a newly created resource in storage using trait.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addImage(ImageRequest $request, Folder $folder)
    {
        $created_image_id = $this->uploadImage($request);
        $image = Image::whereId($created_image_id)->first();
        $image->name = $request->name;
        $image->description = $request->description;
        $folder->image()->save($image);

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        $folder = $folder->load('image');
        return view('library.files.images.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, Folder $folder)
    {
        $folder->image()->delete();
        $new_image_id = $this->uploadImage($request);        
        $image = Image::whereId($new_image_id)->first();
        $image->name = $request->name;
        $image->description = $request->description;
        $folder->image()->save($image);

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder, Image $image)
    {
        $folder->image()->delete();

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been deleted Successfully');
    }
}

