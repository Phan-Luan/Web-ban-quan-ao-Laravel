<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\CheckImage;
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
    public function show()
    {
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['image'] = CheckImage::checkImage($request, 'admin/user');
        $data['role_ids'] = $request->role_ids;
        $data['password'] = Hash::make($request->password);
        $user = $this->user->create($data);
        $user->roles()->attach($data['role_ids']);
        return to_route('admins.users.index')->with(['success' => 'Create user success']);
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
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $user = $this->user->findOrFail($id)->load('roles');
        $data['role_ids'] = $request->role_ids;
        $data['image'] = $request->hasFile('image') ? CheckImage::checkImage($request, 'admin/user') : $user->image;
        // dd($data);
        $user->update($data);
        $user->roles()->sync($data['role_ids'] ?? []);
        return to_route('users.index')->with(['message' => 'update success']);
    }
    public function destroy(string $id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $user->delete();
        return to_route('users.index')->with(['message' => 'delete success']);
    }
}
