<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistsNotSoftDeleted implements ValidationRule
{
    public function __construct(private string $model)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $found = $this->model::find($value);

        if (empty($found)) {
            $fail("The selected $attribute is invalid.");
        }
    }
}
