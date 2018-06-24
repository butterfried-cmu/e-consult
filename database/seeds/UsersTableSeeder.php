<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin1',
                'password' => bcrypt('admin1'),
                'email' => 'econsult.developer@gmail.com',
                'role' => 1,
                'name_title' => 2,
                'first_name' => 'admin',
                'last_name' => 'one',
                'gender' => 1,
                'citizen_id' => '1234567891234',
                'date_of_birth' => '1990-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
            ],
            [
                'username' => 'doctor1',
                'password' => bcrypt('doctor1'),
                'email' => 'econsult.developer@gmail.com',
                'role' => 2,
                'name_title' => 4,
                'first_name' => 'doctor',
                'last_name' => 'two',
                'gender' => 1,
                'citizen_id' => '2345678912345',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
            ],
            [
                'username' => 'nurse1',
                'password' => bcrypt('nurse1'),
                'email' => 'econsult.developer@gmail.com',
                'role' => 3,
                'name_title' => 1,
                'first_name' => 'nurse',
                'last_name' => 'three',
                'gender' => 2,
                'citizen_id' => '3456789123456',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
            ],
        ]);
    }
}
