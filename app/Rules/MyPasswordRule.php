<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MyPasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?_&])[A-Za-z\d@$!%*#?_&]{8,}$/', $value)) {
            $fail('The password need to be at least 8 characters, have at least 1 capital letter, have at least 1 number and have at least 1 special character (?,@!#).');
        }
    }
}
