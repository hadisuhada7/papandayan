<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoverageAreaRequest extends FormRequest
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
            'partner_name' => ['required', 'string', 'max:255'],
            'number_of_cages' => ['required', 'integer'],
            'area' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
        ];
    }
}
