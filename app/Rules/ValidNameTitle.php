<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNameTitle implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ( $value == 'Mr.' || $value == 'Mrs.' || $value == 'Miss' ||
            $value == 'Professor' || $value == 'Assistant Professor' || $value == 'Associate') return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'not_title';
    }
}
