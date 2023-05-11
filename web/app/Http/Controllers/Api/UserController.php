<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @return UserResource
     */
    public function __invoke(UpdateUserRequest $request, User $user)
    {
        $user = User::findOrFail($user->id);
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = Storage::disk('public')->put('avatar', $request->file('avatar'));
        }
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return new UserResource($user);
    }
}
