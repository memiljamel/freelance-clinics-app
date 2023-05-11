<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormsRequest extends FormRequest
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
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'soap' => ['required', 'string', 'min:3', 'max:70'],
            'icd' => ['required', 'string', 'min:3', 'max:70'],
            'doctor_id' => ['required', 'uuid', 'exists:doctors,id'],
        ];
    }
}
