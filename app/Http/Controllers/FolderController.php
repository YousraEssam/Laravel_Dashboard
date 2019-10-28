<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\FolderRequest;
use App\Traits\Uploads;
use Yajra\DataTables\DataTables;

class FolderController extends Controller
{
    use Uploads;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folder = Folder::latest();
        if(request()->ajax()) {
            return DataTables::of($folder)
                ->addIndexColumn()
                ->editColumn(
                    'icon', function(){
                        return "<img src='".asset('folder.jpg')."' style='height:80px; width:80px;'>";
                    }
                )
                ->addColumn(
                    'actions', function ($row) {
                        return view('library.folders.buttons', compact('row'));
                    }
                )
                ->rawColumns(['icon', 'actions'])
                ->make(true);
        }
        return view('library.folders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('library.folders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderRequest $request)
    {
        Folder::create($request->all());

        return redirect()
            ->route('library.folders.index')
            ->with('success', 'New Folder has been created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        $folder= $folder->load(['image', 'file', 'video']);
        return view('library.folders.show', compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        return view('library.folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(FolderRequest $request, Folder $folder)
    {
        $folder->update($request->all());

        return redirect()
            ->route('library.folders.index')
            ->with('success', 'New Folder has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();

        return redirect()
            ->route('library.folders.index')
            ->with('success', 'Folder Deleted Successfully');
    }
}
