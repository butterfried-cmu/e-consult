<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->date('register_date');
            $table->integer('register_by');
            $table->foreign('register_by')->references('user_id')->on('users');
            $table->integer('role');
            $table->foreign('role')->references('role_id')->on('user_roles');
            $table->dateTime('last_login');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('gender');
            $table->foreign('gender')->references('gender_id')->on('genders');
            $table->date('date_of_birth');
            $table->string('contact_number');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
