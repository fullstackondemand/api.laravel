<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!(strlen($value) >= 8))
            $fail('Please enter minimum of eight characters.');

        if (!preg_match('/[A-Z]/', $value))
            $fail('Password must contain at least one uppercase letter.');

        if (!preg_match('/[a-z]/', $value))
            $fail('Password must contain at least one lowercase letter.');

        if (!preg_match('/[0-9]/', $value))
            $fail('Password must contain at least one number.');

        if (!preg_match('/[@#$%^&*()+-]/', $value))
            $fail('Password must contain at least one special characters.');
    }
}