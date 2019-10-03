<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Http\Requests\StaffMemberRequest;
use App\Job;
use App\StaffMember;
use App\Traits\ImageUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class StaffMemberController extends Controller
{
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
        $staff_members = StaffMember::latest()->with('user', 'job', 'city', 'role', 'city.country', 'image');
        if(request()->ajax()) {

            return DataTables::of($staff_members)
                ->addIndexColumn()
                ->editColumn('image', 'staff_members.image')
                ->editColumn(
                    'name', function ($row) {
                        return view('staff_members.fullname', compact('row'));
                    }
                )
                ->editColumn(
                    'is_active', function ($row) {
                        return view('staff_members.activity', compact('row'));
                    }
                )
                ->addColumn('actions', 'staff_members.buttons')
                ->rawColumns(['name', 'image', 'actions', 'is_active'])
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
        $jobs = Job::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        return view('staff_members.create', compact('jobs', 'roles', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffMemberRequest $request)
    {        
        $user = User::create($request->all() + ['password' => Hash::make('Staff123')]);
        $user->assignRole($request->role_id);

        $staffMember = $user->staff()->create($request->all());
        
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request, $staffMember);
            $staffMember->image()->create(['url' => $path]);
        }

        event(new NewStaffMemberHasBeenAddedEvent($staffMember));

        return redirect()
            ->route('staff_members.index')
            ->with('success', 'New Staff Member Has Been Added Successfully and Reset Password Link Has Been Sent');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\StaffMember $staffMember
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
     * @param  \App\StaffMember $staffMember
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffMember $staffMember)
    {
        $jobs = Job::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        return view('staff_members.edit', compact('staffMember', 'jobs', 'roles', 'countries'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\StaffMember         $staffMember
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
            ->with('success', 'Staff Member Has Been Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffMember $staffMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffMember $staffMember)
    {
        //to delete both user and staff or use boot() method in the model
        // to override delete behaviour 
        // $staffMember->user()->delete();
        $staffMember->delete();

        //to delete image from storage
        // Storage::delete($staffMember->image->url);

        //to delete image record from image table
        $staffMember->image()->delete();

        return redirect()->route('staff_members.index')->with('success', 'Staff Member Deleted Successfully');
    }

    /**
     * Toggle Member Status from Active to InActive and vise versa
     */
    public function toggleActivity(StaffMember $staffMember)
    {
        $status = $staffMember->is_active ? 0 : 1;
        $staffMember->update(['is_active' => $status]);
        return "success";
    }
}
