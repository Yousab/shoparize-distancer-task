<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DistanceUnitRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $patternValidated = preg_match('/^[0-9]+\ ([a-zA-Z])+/', $value, $matches);
        $availableUnits = ['yards', 'meters'];

        if ($patternValidated) {
            $explodedValue = explode(' ', $matches[0], 2);
            if (is_numeric($explodedValue[0]) && in_array($explodedValue[1], $availableUnits)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The distance has neither applicable value number nor one of the applicable units (meters, yards).';
    }
}
