<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\StorePatientRequest
     * @return PatientResource
     */
    public function __invoke(StorePatientRequest $request)
    {
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->user_id = $request->user()->id;
        $patient->date_of_birth = $request->input('date_of_birth');
        $patient->address = $request->input('address');
        $patient->type = $request->input('type');
        $patient->allergy = $request->input('allergy');
        $patient->status = $request->input('status');
        $patient->gender = $request->input('gender');
        $patient->doctor_id = $request->input('doctor_id');
        $patient->save();

        return new PatientResource($patient);
    }
}
