<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;
    protected $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }


    public function index(Request $request)
    {
        $search = $request->get(key: 'q');

        $roles = $this->role->latest('id')->where(column: 'name', operator: 'like', value: '%' . $search . '%')->paginate(3);
        return view('admins.roles.index', compact('roles', 'search'));
    }
    public function create()
    {
        $permissions = $this->permission->all()->groupBy('group');

        return view('admins.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();
        $dataCreate['guard_name'] = 'web';
        $role = $this->role->create($dataCreate);
        $role->permissions()->attach($dataCreate['permission_ids']);
        return redirect()->route('roles.index')->with(['message' => 'create role success']);
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->role->with('permissions')->findOrFail($id);
        $permissions = $this->permission->all()->groupBy('group');

        return view('admins.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = $this->role->findOrFail($id);
        $dataUpdate = $request->all();
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permission_ids']);
        return redirect()->route('roles.index')->with(['message' => 'update role success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->role->destroy($id);
        return redirect()->route('roles.index')->with(['message' => 'delete role success']);
    }
}
