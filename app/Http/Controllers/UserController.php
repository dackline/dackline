<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles', function($query) {
            $query->whereNotIn('name', ['customer']);
        })
        ->whereNot('id', auth()->user()->id)
        ->paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Users"]
        ];

        return view('admin.users.list', compact('breadcrumbs', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $breadcrumbs = [
            ['link' => route('admin::users.index'), 'name' => "Users"], ['name' => "Create"]
        ];

        return view('admin.users.form', compact('user', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        $user = User::create($data);

        $user->assignRole('admin');

        return redirect(route('admin::users.index'))->with('success', __('User Created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        $user->load('roles');

        $breadcrumbs = [
            ['link' => route('admin::users.index'), 'name' => __('Users')], ['name' => __('Edit')]
        ];

        return view('admin.users.form', compact('user', 'breadcrumbs', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        // update other details
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // update user password
        if($request->has('password') && !empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        $user->assignRole('admin');

        return redirect(route('admin::users.index'))->with('success', __('User Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', __('User Deleted.'));
    }
}
