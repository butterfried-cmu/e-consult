<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidRole implements Rule
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
     * @param  mixed  $values
     * @return bool
     */
    public function passes($attribute, $values)
    {
//        if ( $value == 'ADMIN' || $value == 'DOCTOR' || $value == 'NURSE' ) return true;
//        return false;
        try{
            foreach ($values as $value) {
                if ($value != 1 && $value != 2 && $value != 3) return false;
            }
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'not_role';
    }
}
