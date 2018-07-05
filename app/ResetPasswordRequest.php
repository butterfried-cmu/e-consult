<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPasswordRequest extends Model
{
    //

    public $timestamps = false;

    protected $primaryKey = 'request_id'; // or null
    public $incrementing = false;

    protected $table = 'reset_password_requests';

    protected $fillable = [
        'request_id',
        'account_username',
    ];

    protected $hidden = [
    ];
}
