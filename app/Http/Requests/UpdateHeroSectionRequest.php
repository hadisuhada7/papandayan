<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'heading' => ['nullable', 'string', 'max:255'],
            'subheading' => ['nullable', 'string', 'max:65535'],
            'link' => ['nullable', 'string', 'max:255'],
            'banner' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'menu_navigation_id' => ['required', 'integer'],
        ];
    }
}
