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
            $table->string('user_id');
            $table->string('name_title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('email');
            $table->string('gender');
            $table->string('citizen_id')->unique();
            $table->date('date_of_birth');
            $table->string('contact_number');
            $table->string('address');
            $table->string('workplace');
            $table->string('image_name')->nullable();
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
