<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardValueRequest extends FormRequest
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
            'value' => 'required|string|max:7',
            'daily_price' => 'required|numeric',
            'placeholder' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Value field is required.',
            'value.string'=>'Value Must Be string',
            'value.max' => 'Value Must Be Less Than 7 Char',

            'daily_price.required' => 'Daily price field is required.',
            'daily_price.string'=>'Daily price Must Be numeric',
            
            'placeholder.required' => 'Placeholder field is required.',
            'placeholder.string'=>'Placeholder Must Be string',    
            ];
    }
}
