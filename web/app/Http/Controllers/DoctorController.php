<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id', null);

        $doctors = Doctor::where('id', 'LIKE', "%{$id}%")
            ->latest()
            ->paginate(10);
        $doctors->appends(['id' => $id]);

        return view('doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialists = Config::get('constant.specialists');
        $days = Config::get('constant.days');

        return view('doctor.create', compact('specialists', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $doctor = new Doctor();
		if ($request->hasFile('avatar')) {
			$doctor->avatar = Storage::disk('public')->put('avatar', $request->file('avatar'));
		}
        $doctor->name = $request->input('name');
        $doctor->specialist = $request->input('specialist');
        $doctor->day = $request->input('day');
        $doctor->date = $request->input('date');
        $doctor->start_time = $request->input('start_time');
        $doctor->end_time = $request->input('end_time');
        $doctor->room = $request->input('room');
        $doctor->signature = Storage::disk('public')->put('signature', $request->file('signature'));
        $doctor->active = $request->has('active');
        $doctor->save();

        return back()->with('message', 'The Doctor has been created.');
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
     * @param  Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $doctor = Doctor::findOrFail($doctor->id);
        
        $specialists = Config::get('constant.specialists');
        $days = Config::get('constant.days');

        return view('doctor.edit', compact('doctor', 'specialists', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoctorRequest  $request
     * @param  Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor = Doctor::findOrFail($doctor->id);
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($doctor->avatar);
            $doctor->avatar = Storage::disk('public')->put('avatar', $request->file('avatar'));
        }
        $doctor->name = $request->input('name');
        $doctor->specialist = $request->input('specialist');
        $doctor->day = $request->input('day');
        $doctor->date = $request->input('date');
        $doctor->start_time = $request->input('start_time');
        $doctor->end_time = $request->input('end_time');
        $doctor->room = $request->input('room');
        if ($request->hasFile('signature')) {
            Storage::disk('public')->delete($doctor->signature);
            $doctor->signature = Storage::disk('public')->put('signature', $request->file('signature'));
        }
        $doctor->active = $request->has('active');
        $doctor->save();

        return back()->with('message', 'The Doctor has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor = Doctor::findOrFail($doctor->id);
        Storage::disk('public')->delete($doctor->avatar);
        Storage::disk('public')->delete($doctor->signature);
        $doctor->delete();

        return back()->with('message', 'The Doctor has been deleted.');
    }
}
