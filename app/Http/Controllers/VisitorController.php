<?php

namespace App\Http\Controllers;

use App\Country;
use App\Events\NewVisitorHasBeenAddedEvent;
use App\Http\Requests\VisitorRequest;
use App\Traits\ImageUpload;
use App\User;
use App\Visitor;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class VisitorController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::latest()->with('user', 'city', 'city.country', 'image');
        if(request()->ajax()) {

            return DataTables::of($visitors)
                ->addIndexColumn()
                ->editColumn('image', 'visitors.image')
                ->editColumn(
                    'name', function ($row) {
                        return view('visitors.fullname', compact('row'));
                    }
                )
                ->editColumn(
                    'is_active', function ($row) {
                        return view('visitors.activity', compact('row'));
                    }
                )
                ->addColumn('actions', 'visitors.buttons')
                ->rawColumns(['name', 'image', 'actions', 'is_active'])
                ->make(true);
        }
        return view('visitors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        return view('visitors.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorRequest $request)
    {
        $user = User::create($request->all() + ['password' => Hash::make('Visitor123')]);
 
        $visitor = $user->visitor()->create($request->all());
        
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request, $visitor);
            $visitor->image()->create(['url' => $path]);
        }
        
        event(new NewVisitorHasBeenAddedEvent($visitor));

        return redirect()
            ->route('visitors.index')
            ->with('success', 'New Visitor Has Been Added Successfully and Reset Password Link Has Been Sent');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        $countries = Country::pluck('name', 'id');
        return view('visitors.edit', compact('visitor', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Visitor             $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorRequest $request, Visitor $visitor)
    {
        $visitor->user->update($request->all());
        $visitor->update($request->all());
        
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request, $visitor);
            $visitor->image()->update(['url' => $path]);
        }

        return redirect()
            ->route('visitors.index')
            ->with('success', 'Visitor Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        // $visitor->user()->delete();
        // Storage::delete($visitor->image->url);
        $visitor->delete();
        $visitor->image()->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor Deleted Successfully');
    }

    /**
     * Toggle Visitor Status from Active to InActive and vise versa
     */
    public function toggleActivity(Visitor $visitor)
    {
        $status = $visitor->is_active ? 0 : 1;
        $visitor->update(['is_active' => $status]);
        return "success";
    }
}
