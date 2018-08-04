<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts_roles')->insert([
            [
                'account_username' => 'admin1',
                'role_id' => 1,
            ],
            [
                'account_username' => 'doctor1',
                'role_id' => 2
            ],
            [
                'account_username' => 'nurse1',
                'role_id' => 3
            ]
        ]);
    }
}
