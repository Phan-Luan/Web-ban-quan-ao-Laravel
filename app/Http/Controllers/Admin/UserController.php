<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index(Request $request)
    {
        $search = $request->get(key: 'q');
        $users = $this->user->latest('id')->where(column: 'name', operator: 'like', value: '%' . $search . '%')->paginate(3);
        return view('admins.users.index', compact('users', 'search'));
    }
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');
        return view('admins.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);
        $user = $this->user->create($dataCreate);
        $user->roles()->attach($dataCreate['role_ids']);
        return to_route('users.index')->with(['success' => 'create user success']);
    }
    public function edit(string $id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $roles = $this->role->all()->groupBy('group');
        return view('admins.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate = $request->except('password');
        $user = $this->user->findOrFail($id)->load('roles');
        if ($request->password) {

            $dataUpdate['password'] = Hash::make($request->password);
        }
        $user->update($dataUpdate);
        $user->roles()->sync($dataUpdate['role_ids'] ?? []);
        return to_route('users.index')->with(['message' => 'update success']);
    }
    public function destroy(string $id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $user->delete();
        return to_route('users.index')->with(['message' => 'delete success']);

    }
}
