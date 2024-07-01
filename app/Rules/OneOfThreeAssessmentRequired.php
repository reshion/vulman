<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OneOfThreeAssessmentRequired implements ValidationRule
{
    protected $fields;

    public function __construct(...$fields)
    {
        $this->fields = $fields;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->fields as $field) {
            if (!empty(request($field))) {
                return;
            }
        }

        $fields = implode(', ', $this->fields);
        $fail("At least one of the following fields must be present: $fields.");
    }
}