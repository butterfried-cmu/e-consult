<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public $timestamps = false;

    protected $primaryKey = 'message_id'; // or null
    public $incrementing = false;

    protected $table = 'messages';

    protected $fillable = [
        'message_id',
        'user_id',
        'consult_id',
        'created_at',
        'message',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function consult()
    {
        return $this->belongsTo('App\Consult', 'consult_id', 'consult_id');
    }
}
