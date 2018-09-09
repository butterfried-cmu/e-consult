<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    public $timestamps = false;

    protected $primaryKey = 'attachment_id'; // or null
    public $incrementing = false;

    protected $table = 'attachments';

    protected $fillable = [
        'attachment_id',
        'consult_id',
        'type',
        'file_name',
    ];

    protected $hidden = [];

    public function consult()
    {
        return $this->belongsTo('App\Consult', 'consult_id', 'consult_id');
    }
}
