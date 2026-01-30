<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:65535'],
            'about' => ['required', 'string', 'max:65535'],
            'author' => ['required', 'string', 'max:255'],
            'viewer' => ['nullable', 'string', 'max:255'],
            'publish_at' => ['required', 'date'],
            'status' => ['required', 'string', 'max:255'],
            'thumbnail' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
        ];
    }
}
