<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'icon' => 'nullable|file|mimes:svg',
            'section' => 'required|in:slide_image,slide_video,head,services,discount,footer',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|mimes:jpeg,png',
            'videos' => 'nullable|array',
            'videos.*' => 'nullable|file|mimes:mp4',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name Field Is Required',
            'name.string' => 'Name Field Must Be Char',
            'name.max' => 'Name Field Must Be Less Than 25 Char',
            'description.required' => 'Description Field Is Required',
            'description.string' => 'Description Field Must Be Char',
            'description.max' => 'Description Field Must Be Less Than 255 Char',
            'icon.file' => 'File Must Be Image.',
            'icon.mimes' => 'Ican Must Be SVG.',
            'section.required' => 'Section Field Is Required.',
            'section.in' => 'Section Value Must Be : slide_image Or slide_video Or head Or services Or discount Or footer',
        ];
    }
}
