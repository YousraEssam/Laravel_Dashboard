<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list', ['only' => ['index','show']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        foreach($roles as $role){
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id",
            "=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
            $role->permissions = $rolePermissions;
        }
        return view('roles.index', [
            'roles' => $roles,
            'size' => sizeof($roles),
            'count' => count($roles),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|string|max:250',
            'permission' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            ]);
        
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = Role::find($role->id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id",
            "=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::find($role->id);
        $permission = Permission::get();
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id",
            "=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->pluck('name', 'name')
            ->all();
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|max:150|string',
            'description' => 'required|string|max:250',
            'permission' => 'required',
        ]);
        $role = Role::find($role->id);
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')
                ->with('success','Role deleted successfully');
    }
}
