<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogoutResource;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return LogoutResource
     */
    public function __invoke(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return new LogoutResource([]);
    }
}
