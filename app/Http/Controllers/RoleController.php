<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', \App\Role::class);
        
        if(request()->ajax()){
            $roles = Role::latest()->with('permissions')->get();
            
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('permissions', function($row){
                    return view('roles.permissions', compact('row'));
                })
                ->addColumn('actions', 'roles.buttons')
                ->rawColumns(['permissions', 'actions'])
                ->make(true);
        }
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', \App\Role::class);
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBlogPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->only(['name', 'description']))
                ->syncPermissions($request->permission);
        return redirect()->route('roles.index')
                        ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view', \App\Role::class);
        $rolePermissions = $role->load('permissions')->permissions;
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', \App\Role::class);
        $allPermissions = Permission::get();
        $rolePermissions = $role->load('permissions')->permissions
                    ->pluck('name', 'name')
                    ->toArray();
        return view('roles.edit', compact('role', 'allPermissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only(['name','description']));
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')
                        ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', \App\Role::class);
        $role->delete();
        return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
    }
}
