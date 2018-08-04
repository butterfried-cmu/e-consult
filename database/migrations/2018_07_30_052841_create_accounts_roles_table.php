<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_roles', function (Blueprint $table) {
            $table->string('account_username');
//            $table->foreign('account_username')->reference('username')->on('accounts');
            $table->integer('role_id');
//            $table->foreign('role_id')->reference('role_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_role');
    }
}
