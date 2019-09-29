<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Http\Requests\StaffMemberRequest;
use App\Job;
use App\Policies\StaffMemberPolicy;
use App\Role;
use App\StaffMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class StaffMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $this->authorize('viewAny', StaffMember::class);
        if(request()->ajax()){
            $staff_members = StaffMember::with('user','job', 'city', 'city.country')->get();

            return DataTables::of($staff_members)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    $img = "<td><img src=".Storage::url($row->image)." style='height:50px; width:50px;'></td>";
                    return $img;
                })
                ->editColumn('name', function($row){
                    $name = "<td>".$row->user->first_name." ".$row->user->last_name."</td>";
                    return $name;
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
        $this->authorize('create', StaffMember::class);
        $jobs = Job::pluck('name','id');
        $roles = Role::pluck('name');
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

        $user->assignRole($attributes['roles']);

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
        $this->authorize('view', StaffMember::class);
        $role = $staffMember->user->getRoleNames()->first();
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
        $this->authorize('update', StaffMember::class);
        $jobs = Job::pluck('name','id');
        $roles = Role::pluck('name');
        $countries = Country::pluck('name','id');
        $role = $staffMember->user->getRoleNames()->first();
        return view('staff_members.edit', compact('staffMember','jobs', 'roles', 'countries', 'role'));
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

        $user->syncRoles($attributes['roles']);
        
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
        $this->authorize('delete', StaffMember::class);
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
