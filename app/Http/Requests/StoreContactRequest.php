<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:contacts,email'],
            'middle_name' => ['sometimes', 'nullable', 'string'],
            'prefix' => ['sometimes', 'nullable'],
            'suffix' => ['sometimes', 'nullable'],
            'title' => ['sometimes', 'nullable', 'string'],

            'default_phone_number.number' => ['required', 'string', 'unique:phone_numbers,number'],
            'default_phone_number.phone_type' => ['required'],
            'default_phone_number.is_default' => ['sometimes', 'boolean'],
        ];
    }
}
