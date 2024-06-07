<?php

namespace App\Http\Requests;

use App\Enums\RiskResponseLifecycleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RiskResponseUpdateRequest extends FormRequest
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
            'assmessment_id' => 'sometimes|required|integer',
            'name' => 'sometimes|string|max:255',
            'created' => 'sometimes|required|date',
            'lifecycle_status' => ['sometimes', 'required', Rule::enum(RiskResponseLifecycleStatus::class)],
        ];
    }
}
