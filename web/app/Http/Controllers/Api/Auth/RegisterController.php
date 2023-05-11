<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use BrowserDetect;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @return RegisterResource
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        $device = BrowserDetect::deviceFamily();

        return (new RegisterResource($user))
            ->additional([
                'token' => $user->createToken($device)->plainTextToken,
            ]);
    }
}
