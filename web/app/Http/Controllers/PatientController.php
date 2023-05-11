<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::latest()->paginate(10);

        return view('patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = Config::get('constant.roles');
		$types = Config::get('constant.types');
        $status = Config::get('constant.status');
		
        $users = User::where('role', '=', $roles[1])
			->orderBy('name')
			->get();
        $doctors = Doctor::where('active', '=', 1)
            ->orderBy('specialist')
            ->get();

        return view('patient.create', compact('users', 'doctors', 'types', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->user_id = $request->input('user_id');
        $patient->date_of_birth = $request->input('date_of_birth');
        $patient->address = $request->input('address');
        $patient->type = $request->input('type');
        $patient->allergy = $request->input('allergy');
        $patient->status = $request->input('status');
        $patient->gender = $request->input('gender');
        $patient->doctor_id = $request->input('doctor_id');
        $patient->save();

        return back()->with('message', 'The Patient has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
		$roles = Config::get('constant.roles');
		$types = Config::get('constant.types');
        $status = Config::get('constant.status');
		
        $patient = Patient::findOrFail($patient->id);
        $users = User::where('role', '=', $roles[1])
			->orderBy('name')
			->get();
        $doctors = Doctor::where('active', '=', 1)
            ->orderBy('specialist')
            ->get();

        return view('patient.edit', compact('patient', 'users', 'doctors', 'types', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient = Patient::findOrFail($patient->id);
        $patient->name = $request->input('name');
        $patient->user_id = $request->input('user_id');
        $patient->date_of_birth = $request->input('date_of_birth');
        $patient->address = $request->input('address');
        $patient->type = $request->input('type');
        $patient->allergy = $request->input('allergy');
        $patient->status = $request->input('status');
        $patient->gender = $request->input('gender');
        $patient->doctor_id = $request->input('doctor_id');
        $patient->save();

        return back()->with('message', 'The Patient has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient = Patient::findOrFail($patient->id);
        $patient->delete();

        return back()->with('message', 'The Patient has been deleted.');
    }
}
