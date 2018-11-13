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
            [
                'username' => 'doctor2',
                'password' => bcrypt('doctor2'),
                'user_id' => '4444444444444'
            ],
            [
                'username' => 'doctor3',
                'password' => bcrypt('doctor3'),
                'user_id' => '5555555555555'
            ],
            [
                'username' => 'doctor4',
                'password' => bcrypt('doctor4'),
                'user_id' => '6666666666666'
            ],
            [
                'username' => 'doctor5',
                'password' => bcrypt('doctor5'),
                'user_id' => '7777777777777'
            ],
            [
                'username' => 'nurse2',
                'password' => bcrypt('nurse2'),
                'user_id' => '8888888888888'
            ],
            [
                'username' => 'nurse3',
                'password' => bcrypt('nurse3'),
                'user_id' => '9999999999999'
            ],
            [
                'username' => 'nurse4',
                'password' => bcrypt('nurse4'),
                'user_id' => 'aaaaaaaaaaaaa'
            ],
            [
                'username' => 'nurse5',
                'password' => bcrypt('nurse5'),
                'user_id' => 'bbbbbbbbbbbbb'
            ],
        ]);
    }
}
