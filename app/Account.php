<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    //

    public $timestamps = false;

    protected $primaryKey = 'username'; // or null
    public $incrementing = false;

    protected $table = 'accounts';

    protected $fillable = [
        'username',
        'password',
        'role',
        'user_id',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];


}
