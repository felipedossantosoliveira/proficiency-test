<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

/**
 * Class CpfValidation
 */
class CpfValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->validateCpf($value)) {
            $fail("The $attribute is invalid.");
        }
    }

    /**
     * @param $cpf
     * @return bool
     */
    public function validateCpf($cpf = null): bool
    {
        if (empty($cpf)) {
            return false;
        }
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        $sequences = ['00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'];
        if (in_array($cpf, $sequences)) {
            return false;
        }
        for ($lenght = 9; $lenght < 11; $lenght++) {
            for ($digit = 0, $counter = 0; $counter < $lenght; $counter++) {
                $digit += $cpf[$counter] * (($lenght + 1) - $counter);
            }
            $digit = ((10 * $digit) % 11) % 10;
            if ($cpf[$counter] != $digit) {
                return false;
            }
        }

        return true;
    }
}
