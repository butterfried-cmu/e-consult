<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('accounts')->insert([
            [
                'username' => 'admin1',
                'password' => bcrypt('admin1'),
                'user_id' => '1111111111111'
            ],
            [
                'username' => 'doctor1',
                'password' => bcrypt('doctor1'),
                'user_id' => '2222222222222'
            ],
            [
                'username' => 'nurse1',
                'password' => bcrypt('nurse1'),
                'user_id' => '3333333333333'
            ],
        ]);
    }
}
