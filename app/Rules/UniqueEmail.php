<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $email = \DB::table("users")->where("email", $value)->exists();

        $cleanedCpf = preg_replace('/[^0-9]/', '', $value);

        $count = \DB::table('customers')->where('cpf', $cleanedCpf)->count();
        if ($count > 0) {
            $fail("The CPF is already in use.");
        }
    }
}
