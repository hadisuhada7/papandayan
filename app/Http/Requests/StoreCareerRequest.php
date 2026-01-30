<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
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
            'position' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'posting_at' => ['required', 'date'],
            'closing_at' => ['required', 'date'],
            'qualification' => ['required', 'string', 'max:65535'],
            'description' => ['required', 'string', 'max:65535'],
            'work_type' => ['required', 'string', 'max:255'],
            'work_experience' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
        ];
    }
}
