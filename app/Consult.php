<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    //
    public $timestamps = true;

    protected $primaryKey = 'consult_id'; // or null
    public $incrementing = false;

    protected $table = 'consults';

    protected $fillable = [
        'consult_id',
        'user_id',
        'status',
        'patient_firstname',
        'patient_lastname',
        'patient_dob',
        'patient_gender',
        'patient_address',
        'primary_doctor',
        'health_condition',
        'med_hn',
        'med_dx',
        'med_bw',
        'med_bmi',
        'med_t',
        'med_fbs',
        'med_cr',
        'med_clearance',
        'med_stage',
        'rec01_date',
        'rec01_fbs',
        'rec01_bp1',
        'rec01_bp2',
        'rec01_p',
        'rec02_date',
        'rec02_fbs',
        'rec02_bp1',
        'rec02_bp2',
        'rec02_p',
        'consult_complain',
        'consult_plan',
        'consult_order',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
