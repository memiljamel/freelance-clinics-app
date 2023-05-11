<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.edit', compact('user'));
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
        $user = User::findOrFail(Auth::user()->id);
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
}
