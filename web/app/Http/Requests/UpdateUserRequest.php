<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
            'name' => ['required', 'string', 'min:3', 'max:70'],
            'email_verified_at' => ['nullable', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'password' => ['nullable', 'string', 'min:8', 'max:70'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'phone_number' => ['nullable', 'numeric', 'digits_between:11,13'],
        ];
    }
}
