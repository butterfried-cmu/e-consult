<?php
namespace App\Helpers;

class AppHelper
{
    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateUserID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if (userIDExists($id)) {
            return generateUserID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function userIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return User::where('user_id', $id)->exists();
    }

    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateUserID1()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if (userIDExists($id)) {
            return generateUserID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function userIDExists1($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return User::find($id)->exists();
    }

}
