<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Resources\ForgotResource;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\ForgotRequest $request
     * @return ForgotResource
     */
    public function __invoke(ForgotRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return new ForgotResource([]);
        }

        throw ValidationException::withMessages([
            'email' => __($status),
        ]);
    }
}
