<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Http\Requests\StaffMemberRequest;
use App\Image;
use App\Job;
use App\Policies\StaffMemberPolicy;
use App\Role;
use App\StaffMember;
use App\Traits\ImageUpload;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class StaffMemberController extends Controller
{
    use SoftDeletes;
    use ImageUpload;

    public function __construct()
    {
        $this->authorizeResource(StaffMember::class, 'staff_members');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $staff_members = StaffMember::latest()->with('user','job', 'city', 'role', 'city.country', 'image');
        if(request()->ajax()){

            return DataTables::of($staff_members)
                ->addIndexColumn()
                ->editColumn('image', 'staff_members.image')
                ->editColumn('name', function($row){
                    return view('staff_members.fullname', compact('row'));
                })
                ->addColumn('actions', 'staff_members.buttons')
                ->rawColumns(['name', 'image', 'actions'])
                ->make(true);
        }
        return view('staff_members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::pluck('name','id');
        $roles = Role::pluck('name','id');
        $countries = Country::pluck('name','id');
        return view('staff_members.create', compact('jobs', 'roles', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffMemberRequest $request)
    {        
        $user = User::create($request->all() + ['password' => Hash::make(Str::random(8))]);
 
        $staffMember = $user->staff()->create($request->all());
        
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request, $staffMember);
            $staffMember->image()->create(['url' => $path]);
        }
        
        event(new NewStaffMemberHasBeenAddedEvent($staffMember));

        return redirect()
            ->route('staff_members.index')
            ->with('success', 'New Staff Member Added Successfully and Reset Password Link Has Been Sent');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function show(StaffMember $staffMember)
    {
        $role = $staffMember->role();
        return view('staff_members.show', compact('staffMember', 'role'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffMember $staffMember)
    {
        $jobs = Job::pluck('name','id');
        $roles = Role::pluck('name','id');
        $countries = Country::pluck('name','id');
        return view('staff_members.edit', compact('staffMember','jobs', 'roles', 'countries'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function update(StaffMemberRequest $request, StaffMember $staffMember)
    {
        $staffMember->user->update($request->all());
        $staffMember->update($request->all());
        
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request, $staffMember);
            $staffMember->image()->update(['url' => $path]);
        }

        return redirect()
            ->route('staff_members.index')
            ->with('success', 'Staff Member Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffMember $staffMember)
    {
        $staffMember->user()->delete();
        Storage::delete($staffMember->image->url);
        $staffMember->image()->delete();

        return redirect()->route('staff_members.index')->with('success', 'Staff Member Deleted Successfully');
    }
    
    /**
     * Get List of All Cities related to specific Country
     */
    public function getCityList(Request $request)
    {
        $cities = City::where("country_id",$request->country_id)->pluck("name","id");
        return response()->json($cities);
    }
}
