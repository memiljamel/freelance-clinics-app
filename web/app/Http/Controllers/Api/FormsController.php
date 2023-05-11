<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormsResource;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class FormsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return FormsResource
     */
    public function __invoke(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        $pdf = PDF::loadView('pdf.forms', compact('user'));
        $pdf->setPaper('a4');
        $pdf->setOrientation('portrait');
        $pdf->save(storage_path("app/public/forms/{$user->id}-Form.pdf"), true);

        return new FormsResource($user);
    }
}
