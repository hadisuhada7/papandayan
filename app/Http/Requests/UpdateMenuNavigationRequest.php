<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuNavigationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'icon' => ['nullable', 'string', 'max:255'],
            'menu_group_id' => ['required', 'integer', 'exists:menu_groups,id'],
        ];
    }
}
