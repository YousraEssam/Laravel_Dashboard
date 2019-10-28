<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\VideoRequest;
use App\Traits\Uploads;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Uploads;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {
        return view('library.files.videos.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $this->uploadVideo($request);
        return response()->json(['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addVideo(VideoRequest $request, Folder $folder)
    {
        $created_video_id = $this->uploadVideo($request);
        $video = Video::whereId($created_video_id)->first();
        $video->name = $request->name;
        $video->description = $request->description;
        $folder->video()->save($video);

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Video has been created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        $folder = $folder->load('video');
        return view('library.files.videos.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Folder $folder)
    {
        $folder->video()->delete();
        $new_video_id = $this->uploadVideo($request);        
        $video = Video::whereId($new_video_id)->first();
        $video->name = $request->name;
        $video->description = $request->description;
        $folder->video()->save($video);

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New video has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder, Video $video)
    {
        $folder->video()->delete();

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been deleted Successfully');
    }
}
