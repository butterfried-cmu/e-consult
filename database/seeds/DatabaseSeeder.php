<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
//        $this->call(GenderTableSeeder::class);
//        $this->call(NameTitleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(ResetPasswordRequestSeeder::class);
    }
}
