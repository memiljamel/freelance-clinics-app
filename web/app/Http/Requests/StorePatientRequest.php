<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:70'],
            'user_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'address' => ['required', 'string', 'min:3', 'max:255', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'type' => ['required', 'string', 'in:General,JKN'],
            'allergy' => ['required', 'string', 'min:3', 'max:70'],
            'status' => ['required', 'string', 'in:Married,Single'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'doctor_id' => ['required', 'uuid', 'exists:doctors,id'],
        ];
    }
}
