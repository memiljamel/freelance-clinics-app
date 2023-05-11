<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ResetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->input('token');

        return view('auth.reset', compact('token'));
    }

    /**
     * Handle send password reset link.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function recovery(ResetRequest $request)
    {
        $roles = Config::get('constant.roles');

        $status = Password::reset([
            'token' => $request->input('token'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $roles[0],
        ], function ($user, $password) {
            $user->forceFill([
                'password' => $password,
            ])->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.index')->with('message', __($status))
            : back()->withInput()
                ->withErrors(['email' => [__($status)]]);
    }
}
