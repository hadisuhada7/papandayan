<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerApplicantRequest extends FormRequest
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
        if ($this->has('status')) {
            return [
                'status' => ['required', 'string', 'max:255'],
                'reject_reason' => ['nullable', 'string', 'max:500'],
            ];
        }

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'bod' => ['required', 'date'],
            'education' => ['required', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'experienced' => ['required', 'string', 'max:255'],
            'current_salary' => ['required', 'integer'],
            'expectation_salary' => ['required', 'integer'],
            'status' => ['required', 'string', 'max:255'],
            'reject_reason' => ['nullable', 'string', 'max:500'],
            'curriculum_vitae' => ['sometimes', 'file', 'mimes:pdf', 'max:5120'],
            'career_id' => ['required', 'integer'],

            // Experienced Applicant fields
            'company_name' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
        ];
    }
}
