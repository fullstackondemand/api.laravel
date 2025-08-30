<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required_without:email|string',
            'email' => 'required_without:username|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required_without' => 'Either email or username is required.',
            '*.required' => 'This field is required.',
        ];
    }

    // if form data is invalid
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->badRequest($validator->errors()));
    }
}