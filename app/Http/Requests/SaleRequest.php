<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'name' => 'required|max:25',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:50|min:9',
            'transaction_number' => 'required|min:25|max:30',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.max' => 'Name Must Be Less Than 25 Char',

            'email.required' => 'Email field is required.',
            'email.email' => 'Email Must Be Email.',

            'phone.required' => 'Phone field is required.',
            'phone.max' => 'Phone must be less than 50 characters.',
            'phone.min' => 'Phone must be More than 9 characters.',
            'phone.regex' => 'Phone must contain only numbers, spaces, hyphens, plus signs, and parentheses.',

            'transaction_number.required' => 'Phone field is required.',
            'transaction_number.max' => 'Phone must be less than 30 characters.',
            'transaction_number.min' => 'Phone must be More than 25 characters.',
        ];
    }
}
