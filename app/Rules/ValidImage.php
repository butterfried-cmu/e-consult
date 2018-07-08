<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Image;

class ValidImage implements Rule
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
//        try{
//            \Image::make($value);
//            return true;
//        }catch (\Exception $exception){
//            return false;
//        }
        try {
            $image = $value;
            if ( $image == ''){
                return true;
            }

            if (strpos($image, 'data:image/png;base64,') !== false || strpos($image, 'data:image/jpeg;base64,') !== false ){
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = 'temp.jpg';
                \File::put(public_path(''). '/' . $imageName, base64_decode($image));
                return true;
            }else{
                return false;
            }
        }catch (\Exception $exception){
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
        return 'image';
    }
}
