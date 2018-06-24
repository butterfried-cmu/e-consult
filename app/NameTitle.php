<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NameTitle extends Model
{
    protected $table = 'name_titles';

    public function users()
    {
        return $this->hasMany('App\User');
    }

}
