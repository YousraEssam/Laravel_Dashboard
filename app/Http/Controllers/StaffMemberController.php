<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Http\Requests\StaffMemberRequest;
use App\Job;
use App\Role;
use App\StaffMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $staff_members = StaffMember::with('user','job', 'city', 'role')->get();
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
        
        $attributes= $request->all();
        
        if($request->file('image')){
            $path = Storage::putFile('public/uploads', $request->file('image'));
            $attributes['image'] = $path;
        }

        $user = User::create($request->all()+['password' => Hash::make('Staff123')]);
        
        $attributes['user_id'] = $user->id;
        
        $staffMember = StaffMember::create($attributes);

        event(new NewStaffMemberHasBeenAddedEvent($staffMember));

        return redirect()->route('staff_members.index')->with('success', 'New Staff Member Added Successfully and Reset Password Link Has Been Sent');
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
        // $cities = City::pluck('name','id')->all();
        // $countries = Country::pluck('name','id')->all();
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
        $attributes= $request->all();
        
        if($request->hasFile('image')){
            $path = Storage::putFile('public/uploads', $request->file('image'));
            $attributes['image'] = $path;
        }

        $user = $staffMember::with('user')->first()->user;
        $user->update($request->all());

        $attributes['user_id'] = $user->id;

        $staffMember->update($attributes);
        
        return redirect()->route('staff_members.index')->with('success', 'Staff Member Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffMember $staffMember)
    {
        $staffMember->user->delete();
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
