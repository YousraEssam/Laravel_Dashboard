<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\VideoRequest;
use App\Traits\Uploads;
use App\Video;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class VideoController extends Controller
{
    use Uploads;

    public function __construct()
    {
        $this->authorizeResource(Folder::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {
        return view('library.files.videos.create', compact('folder'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $id = $this->uploadVideo($request);
    //     return response()->json(['id' => $id]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request, Folder $folder)
    {
        if($request->file('video'))
        {
            $created_video_id = $this->uploadVideo($request);
            $video = Video::whereId($created_video_id)->first();
            $video->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            $folder->video()->save($video);
        }elseif($request->video)
        {
            $video = $this->getYoutubeID($request->video);
            $folder->video()->create([
                'name' => $request->name,
                'description' => $request->description,
                'url' => 'http://www.youtube.com/embed/'.$video,
            ]);
        }

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
    public function edit(Folder $folder, Video $video)
    {
        return view('library.files.videos.edit', compact('folder', 'video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Folder $folder, Video $video)
    {
        if($request->file('video') !== null)
        {
            $video->delete();
            $new_video_id = $this->uploadVideo($request);        
            $video = Video::whereId($new_video_id)->first();
            $video->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            $folder->video()->save($video);
        }elseif($request->file('video') == null)
        {
            $video->update($request->all());
        }elseif($request->video)
        {
            $video = $this->getYoutubeID($request->video);
            $folder->video()->create([
                'name' => $request->name,
                'description' => $request->description,
                'url' => 'http://www.youtube.com/embed/'.$video,
            ]);
        }

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
        $video->delete();

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been deleted Successfully');
    }

    public function getYoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }
        return $url;
    }

}
