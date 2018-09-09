<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->string('consult_id');
            $table->string('user_id');
            $table->string('status');
            $table->string('patient_firstname');
            $table->string('patient_lastname');
            $table->date('patient_dob');
            $table->string('patient_gender');
            $table->string('patient_address');
            $table->string('primary_doctor');
            $table->string('health_condition');
            $table->string('med_hn');
            $table->string('med_dx');
            $table->string('med_bw');
            $table->string('med_bmi');
            $table->string('med_t');
            $table->string('med_fbs');
            $table->string('med_cr');
            $table->string('med_clearance');
            $table->string('med_stage');
            $table->date('rec01_date');
            $table->string('rec01_fbs');
            $table->string('rec01_bp1');
            $table->string('rec01_bp2');
            $table->string('rec01_p');
            $table->date('rec02_date');
            $table->string('rec02_fbs');
            $table->string('rec02_bp1');
            $table->string('rec02_bp2');
            $table->string('rec02_p');
            $table->string('consult_complain');
            $table->string('consult_plan');
            $table->string('consult_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consult');
    }
}
