<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
        'name_title',
        'first_name',
        'last_name',
        'gender',
        'citizen_id',
        'date_of_birth',
        'contact_number',
        'address',
        'workplace'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','created_at', 'updated_at', 'remember_token',
    ];


    public function role()
    {
        return $this->belongsTo('App\Role','role');
    }

    public function name_title()
    {
        return $this->belongsTo('App\NameTitle','name_title');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender', 'gender');
    }

}
