<?php

use Illuminate\Database\Seeder;

class ResetPasswordRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * reset_password_requests
     */
    public function run()
    {
        DB::table('reset_password_requests')->insert([
            [
                'request_id' => '1234567891234',
                'account_username' => 'admin1',
            ],
            [
                'request_id' => '4321987654321',
                'account_username' => 'doctor1'
            ]
        ]);
    }
}
