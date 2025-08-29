<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|alpha_num|min:6|unique:users,username',
            'password' => ['required', 'confirmed', new Password],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required.',
            '*.email' => 'Please enter valid email address.',
            '*.confirmed' => 'Your passwords do no match.',
            'email.unique' => 'This email address is already registered.',
            '*.min' => 'Please enter minimum of six characters.',
            '*.alpha_num' => 'Please use only letter {a-z} and numbers.',
        ];
    }

    // if form data is invalid
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 400));
    }
}