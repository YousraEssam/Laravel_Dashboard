<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\FolderRequest;
use App\Traits\Uploads;
use Yajra\DataTables\DataTables;

class FolderController extends Controller
{
    use Uploads;

    public function __construct()
    {
        $this->authorizeResource(Folder::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all folders related to the logged in user
        if(auth()->user()->hasRole('Admin')){
            $folders = Folder::latest();
        }else{
        $folders = Folder::wherehas('staff_members',function($query){
            $query->where('staff_member_id',auth()->user()->staff->id);
        })->get();
        }
        if(request()->ajax()) {
            return DataTables::of($folders)
            ->addIndexColumn()
            ->editColumn('icon', function(){
                    return "<img src='".asset('folder.jpg')."' style='height:80px; width:80px;'>";
                })
            ->addColumn('actions', 'library.folders.buttons')
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
        $folder = Folder::create($request->all());
        $folder->staff_members()->attach($request->staff);
        
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
        $permitted_staff = $folder->staff_members()->get()->pluck('user.full_name', 'id');
        return view('library.folders.edit', compact('folder', 'permitted_staff'));
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
        $folder->update($request->only(['name', 'description']));
        $folder->staff_members()->sync($request->staff);

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
        $folder->staff_members()->detach();
        
        return redirect()
            ->route('library.folders.index')
            ->with('success', 'Folder Deleted Successfully');
    }
}
