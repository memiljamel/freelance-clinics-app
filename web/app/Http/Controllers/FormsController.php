<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFormsRequest;
use App\Models\Forms;
use App\Models\Patient;

class FormsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $patient = Patient::findOrFail($patient->id);

        return view('forms.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormsRequest $request, Patient $patient)
    {
        $forms = Forms::firstOrNew([
            'patient_id' => $patient->id,
        ]);
        $forms->user_id = $request->input('user_id');
        $forms->patient_id = $request->input('patient_id');
        $forms->date = $request->input('date');
        $forms->soap = $request->input('soap');
        $forms->icd = $request->input('icd');
        $forms->doctor_id = $request->input('doctor_id');
        $forms->save();

        return back()->with('message', 'The Forms has been updated.');
    }
}
