<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')->ignore($this->id),
            ],
            'middle_name' => ['sometimes', 'nullable', 'string'],
            'prefix' => ['sometimes', 'nullable'],
            'suffix' => ['sometimes', 'nullable'],
            'title' => ['sometimes', 'nullable', 'string'],

            'phone_numbers.*.number' => [
                'required',
                'string',
                Rule::unique('phone_numbers', 'number')->whereNot('contact_id', $this->id),
            ],
            'phone_numbers.*.phone_type' => ['required'],
            'phone_numbers.*.is_default' => ['sometimes', 'boolean'],
        ];
    }
}
