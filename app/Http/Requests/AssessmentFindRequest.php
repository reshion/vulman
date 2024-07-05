<?php

namespace App\Http\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Rules\OneOfThreeAssessmentRequired;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssessmentFindRequest extends FormRequest
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
        ];
    }
}
