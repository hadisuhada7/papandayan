<?php

namespace App\Http\Requests;

use App\Models\MenuGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreMenuNavigationRequest extends FormRequest
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
            'menu_group_id' => ['nullable', function ($attribute, $value, $fail) {
                // Allow 'null' string or valid UUID
                if ($value === 'null' || $value === null) {
                    return;
                }
                // Check if it's a valid UUID and exists in menu_groups table
                if (!Str::isUuid($value)) {
                    $fail('The menu group must be a valid UUID.');
                    return;
                }
                if (!MenuGroup::where('id', $value)->exists()) {
                    $fail('The selected menu group does not exist.');
                }
            }],
        ];
    }
}
