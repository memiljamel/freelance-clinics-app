<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id', null);

        $roles = Config::get('constant.roles');

        $users = User::where([
            ['role', '=', $roles[1]],
            ['id', 'LIKE', "%{$id}%"],
        ])
            ->latest()
            ->paginate(10);
        $users->appends(['id' => $id]);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        if ($request->hasFile('avatar')) {
            $user->avatar = Storage::disk('public')->put('avatar', $request->file('avatar'));
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->email_verified_at = $request->input('email_verified_at');
        $user->password = $request->input('password');
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return back()->with('message', 'The User has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = User::findOrFail($user->id);
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = Storage::disk('public')->put('avatar', $request->file('avatar'));
        }
        $user->name = $request->input('name');
        $user->email_verified_at = $request->input('email_verified_at');
        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return back()->with('message', 'The User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        Storage::disk('public')->delete($user->avatar);
        Storage::disk('public')->delete("forms/{$user->id}-Form.pdf");
        $user->delete();

        return back()->with('message', 'The User has been deleted.');
    }
}
