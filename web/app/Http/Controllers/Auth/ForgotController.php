<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.forgot');
    }

    /**
     * Handle send password reset link.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function email(ForgotRequest $request)
    {
        $roles = Config::get('constant.roles');

        $status = Password::sendResetLink([
            'email' => $request->input('email'),
            'role' => $roles[0],
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('message', __($status))
            : back()->withInput()
                ->withErrors(['email' => __($status)]);
    }
}
