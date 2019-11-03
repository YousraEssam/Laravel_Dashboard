<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use App\Http\Requests\FileRequest;
use App\Traits\Uploads;
use Illuminate\Http\Request;

class FileController extends Controller
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
        return view('library.files.files.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addFile(Request $request)
    {
        $id = $this->uploadFileDb($request);
        return response()->json(['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request, Folder $folder)
    {
        $created_file_path = $this->uploadFile($request);
        $file = File::create($request->only(['name','description'])+['file_url' => $created_file_path]);
        $folder->file()->save($file);

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New file has been created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder, File $file)
    {
        return view('library.files.files.edit', compact('folder', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(FileRequest $request, Folder $folder, File $file)
    {
        if($request->file('file')){
            $created_file_path = $this->uploadFile($request);
            $folder->file()->update($request->only(['name','description'])+['file_url' => $created_file_path]);
        }else{
            $file->update($request->all());
        }
        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New file has been updated Successfully');
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder, File $file)
    {
        $file->delete();

        return redirect()
            ->route('library.folders.show', $folder->id)
            ->with('success', 'New Image has been deleted Successfully');
    }
}
