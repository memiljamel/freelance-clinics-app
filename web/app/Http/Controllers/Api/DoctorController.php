<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\StorePatientRequest
     * @return DoctorResource
     */
    public function __invoke(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $keyword = $request->query('keyword', null);
        $active = $request->query('active', 0);

        $doctors = Doctor::where('specialist', 'LIKE', "%{$keyword}%")
            ->orWhere('name', 'LIKE', "%{$keyword}%")
            ->when($active, function ($query, $active) {
                return $query->where('active', '=', $active);
            })
            ->orderBy('specialist')
            ->paginate($perPage);
        $doctors->appends([
            'per_page' => $perPage,
            'keyword' => $keyword,
            'active' => $active,
        ]);

        return new DoctorResource($doctors);
    }
}
