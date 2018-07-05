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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->integer('role');
            $table->integer('name_title');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('gender');
            $table->string('citizen_id')->unique();
            $table->date('date_of_birth');
            $table->string('contact_number');
            $table->string('address');
            $table->string('workplace');
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
        Schema::dropIfExists('users');
    }
}
