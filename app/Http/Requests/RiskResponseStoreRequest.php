<?php

namespace App\Http\Requests;

use App\Enums\RiskResponseLifecycleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RiskResponseStoreRequest extends FormRequest
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
            'assessment_id' => 'required|integer',
            'name' => 'string|max:255',
            'created' => 'required|date',
            'lifecycle_status' => [Rule::enum(RiskResponseLifecycleStatus::class)],
        ];
    }
}
