<?php

namespace App\Http\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\RiskResponseLifecycleStatus;
use App\Rules\OneOfThreeAssessmentRequired;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssessmentStoreRequest extends FormRequest
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
            'name' => 'string|max:255',            
            'vulnerability_id' => 'required:vulnerabilities,id',
            'company_id' => [
                'nullable',
                'exists:companies,id',
                new OneOfThreeAssessmentRequired('asset_id', 'system_group_id', 'company_id')
            ],
            'system_group_id' => [
                'nullable',
                'exists:system_groups,id',
                new OneOfThreeAssessmentRequired('asset_id', 'system_group_id', 'company_id')
            ],
            'asset_id' => [
                'nullable',
                'exists:assets,id',
                new OneOfThreeAssessmentRequired('asset_id', 'system_group_id', 'company_id')
            ],
            'lifecycle_status' => [Rule::enum(AssessmentLifecycleStatus::class)],
            'risk_response_name' => 'nullable|string|max:255',
            'risk_response_lifecycle_status' => [
                'nullable',
                Rule::enum(RiskResponseLifecycleStatus::class)],
        ];
    }
}
