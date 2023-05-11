<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use App\Http\Resources\ResetResource;
use App\Models\User;
use BrowserDetect;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\ResetRequest $request
     * @return ResetResource
     */
    public function __invoke(ResetRequest $request)
    {
        $status = Password::reset(
            $request->only(['token', 'email', 'password']),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password,
                ])->setRememberToken(Str::random(60));
                $user->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $user = User::where('email', $request->input('email'))->first();
            $device = BrowserDetect::deviceFamily();

            return (new ResetResource($user))
                ->additional([
                    'token' => $user->createToken($device)->plainTextToken,
                ]);
        }

        throw ValidationException::withMessages([
            'email' => __($status),
        ]);
    }
}
