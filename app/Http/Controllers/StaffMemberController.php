<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Http\Requests\StoreStaffMemberRequest;
use App\Http\Requests\UpdateStaffMemberRequest;
use App\Job;
use App\Role;
use App\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SplFileInfo;

class StaffMemberController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:staffmember-list|staffmember-create|staffmember-edit|staffmember-delete', ['only' => ['index','show']]);
         $this->middleware('permission:staffmember-create', ['only' => ['create','store']]);
         $this->middleware('permission:staffmember-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:staffmember-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff_members = StaffMember::with('job', 'city', 'role')->get();
        return view('staff_members.index', compact('staff_members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $cities = City::pluck('name','id')->all();
        $countries = Country::pluck('name','id')->all();
        return view('staff_members.create', compact('staffMember' ,'jobs', 'roles', 'cities', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffMemberRequest $request)
    {
        if($request->hasFile('image')){
            $imageName = $request->file('image') ?? $request['image'];

            if($imageName){
                $originalName = $imageName->getClientOriginalName();

                $path = $request->image->storeAs('', time().$originalName);
                $attributes= $request->all();

                $attributes['image'] = $path;
                
                StaffMember::create($attributes);

                return redirect()->route('staff_members.index')->with('success', 'New Staff Member Added Successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function show(StaffMember $staffMember)
    {
        return view('staff_members.show', compact('staffMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffMember $staffMember)
    {
        $jobs = Job::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $cities = City::pluck('name','id')->all();
        $countries = Country::pluck('name','id')->all();
        return view('staff_members.edit', compact('staffMember' ,'jobs', 'roles', 'cities', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffMemberRequest $request, StaffMember $staffMember)
    {
        if($request->hasFile('image')){
            $imageName = $request->file('image') ?? $request['image'];

            if($imageName){
                $originalName = $imageName->getClientOriginalName();

                $path = $request->image->storeAs('', time().$originalName);
                $attributes= $request->all();

                $attributes['image'] = $path;
                
                $staffMember->update($attributes);

                return redirect()->route('staff_members.index')->with('success', 'Staff Member Updated Successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffMember $staffMember)
    {
        $staffMember->delete();
        return redirect()->route('staff_members.index')->with('success', 'Staff Member Deleted Successfully');
    }

}
