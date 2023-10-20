<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'content' => 'required|min:25',
            'subject' => 'required|string|max:50'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.max' => 'Name Must Be Less Than 25 Char',

            'content.required' => 'Content field is required.',
            'content.min' => 'Content Must Be More Than 25 Char',

            'email.required' => 'Email field is required.',
            'email.email' => 'Email Must Be Email.',

            'phone.required' => 'Phone field is required.',
            'phone.max' => 'Phone must be less than 50 characters.',
            'phone.min' => 'Phone must be More than 9 characters.',
            'phone.regex' => 'Phone must contain only numbers, spaces, hyphens, plus signs, and parentheses.',

            'subject.required' => 'Subject field is required.',
            'subject.string' => 'Subject Must Be Only Text.',
            'subject.max' => 'Subject Must Be Less Than 50 Char'
        ];
    }
}
