<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRequest;
use App\Http\Resources\ChangeResource;
use App\Models\User;

class ChangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\ChangeRequest $request
     * @return ChangeResource
     */
    public function __invoke(ChangeRequest $request, User $user)
    {
        $user = User::findOrFail($user->id);
        $user->password = $request->input('password');
        $user->save();

        $user->tokens()->delete();

        return new ChangeResource($user);
    }
}
