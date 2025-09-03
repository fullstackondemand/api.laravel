<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        /** Get Route User */
        $user = $this->route('user');

        return [
            'name' => $user ? 'required_without_all:email,username,password' : 'required',
            'email' => ($user ? 'required_without_all:name,username,password' : 'required') . '|email|unique:users,email',
            'username' => ($user ? 'required_without_all:name,email,password' : 'required') . "|alpha_num|min:6|unique:users,username",
            'password' => [$user ? 'required_without_all:name,email,username' : 'required', new Password, 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required.',
            '*.required_without_all' => 'This field is required.',
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
        throw new HttpResponseException(response()->badRequest($validator->errors()));
    }
}