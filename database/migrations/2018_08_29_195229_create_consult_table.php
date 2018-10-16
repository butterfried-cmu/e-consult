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
            $table->string('med_dx')->nullable();
            $table->string('med_bw')->nullable();
            $table->string('med_bmi')->nullable();
            $table->string('med_t')->nullable();
            $table->string('med_fbs')->nullable();
            $table->string('med_cr')->nullable();
            $table->string('med_clearance')->nullable();
            $table->string('med_stage')->nullable();
            $table->date('rec01_date')->nullable();
            $table->string('rec01_fbs')->nullable();
            $table->string('rec01_bp1')->nullable();
            $table->string('rec01_bp2')->nullable();
            $table->string('rec01_p')->nullable();
            $table->date('rec02_date')->nullable();
            $table->string('rec02_fbs')->nullable();
            $table->string('rec02_bp1')->nullable();
            $table->string('rec02_bp2')->nullable();
            $table->string('rec02_p')->nullable();
            $table->string('consult_complain');
            $table->string('consult_plan')->nullable();
            $table->string('consult_order');
            $table->timestamps();
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
