<?php

namespace App\Http\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\AssessmentTreatment;
use App\Enums\RiskResponseLifecycleStatus;
use App\Rules\OneOfThreeAssessmentRequired;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssessmentUpdateRequest extends FormRequest
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
            'note' => 'sometimes|string|max:255',           
            'treatment' => [
                'nullable',
                Rule::enum(AssessmentTreatment::class)],

            'lifecycle_status' => [
                'nullable',
                Rule::enum(AssessmentLifecycleStatus::class)],

            'risk_response' => 'nullable|string|max:255',
            
            'risk_response_lifecycle_status' => [
                'nullable',
                Rule::enum(RiskResponseLifecycleStatus::class)],
        ];
    }
}
