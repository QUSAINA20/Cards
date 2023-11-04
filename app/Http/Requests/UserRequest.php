<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [            
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|same:confirm-password',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:50|min:9',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',

            'email.required' => 'Email field is required.',
            'email.email' => 'Email Must Be Email.',
            'email.unique:users,email' => 'Email Must Be unique.',

            'password.required' => 'Password field is required.',
            'password.string'=>'Password Must Be string',
            'password.max' => 'Password Must Be More Than 6 Char',
            'password.same:confirm-password' => 'Password Must Be same confirm password',

            'phone.max' => 'Phone must be less than 50 characters.',
            'phone.min' => 'Phone must be More than 9 characters.',
            'phone.regex' => 'Phone must contain only numbers, spaces, hyphens, plus signs, and parentheses.',

        ];
    }
}
