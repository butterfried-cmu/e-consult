<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
//    use Notifiable;

    public $timestamps = false;

    protected $primaryKey = 'user_id'; // or null
    public $incrementing = false;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'name_title',
        'first_name',
        'last_name',
        'gender',
        'citizen_id',
        'date_of_birth',
        'contact_number',
        'address',
        'workplace',
        'image_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','created_at', 'updated_at', 'remember_token',
    ];
}
