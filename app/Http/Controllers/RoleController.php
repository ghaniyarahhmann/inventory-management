<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $permissions = \App\Models\Permission::orderBy('name')->get();

    return view('roles.create', compact('permissions'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role = Role::create([
        'name' => $request->name,
    ]);

    $role->permissions()->sync($request->permissions ?? []);

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role created successfully.');
}

    /**
     * Display the specified resource.
     */
   public function show(Role $role)
{
    $role->load('permissions');

    return view('roles.show', compact('role'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Role $role)
{
    $role->load('permissions');

    $permissions = \App\Models\Permission::orderBy('name')->get();

    return view('roles.edit', compact('role', 'permissions'));
}

    /**
     * Update the specified resource in storage.
     */
    
public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role->update([
        'name' => $request->name,
    ]);

    $role->permissions()->sync($request->permissions ?? []);

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    
public function destroy(Role $role)
{
    if ($role->users()->exists()) {
        return redirect()
            ->route('roles.index')
            ->with('error', 'This role cannot be deleted because it is assigned to one or more users.');
    }

    $role->permissions()->detach();

    $role->delete();

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role deleted successfully.');
}
}
