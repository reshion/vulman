<?php

namespace App\Http\Requests;

use App\Enums\AssessmentLifecycleStatus;
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
            'name' => 'sometimes|string|max:255',
            'created' => 'sometimes|required|date',
            'vulnerability_id' => 'required|exists:vulnerabilities,id',
            'company_id' => 'required|exists:companies,id',
            'system_group_id' => 'required|exists:system_groups,id',
            'asset_id'  => 'required|exists:assets,id',
            'lifecycle_status' => ['sometimes','required', Rule::enum(AssessmentLifecycleStatus::class)],
        ];
    }
}
