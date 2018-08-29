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
                'user_id' => '1111111111111',
                'email' => 'econsult.developer@gmail.com',
                'name_title' => "Mr.",
                'first_name' => 'admin',
                'last_name' => 'one',
                'position' => 'Administrator',
                'gender' => 'Male',
                'citizen_id' => '1234567891234',
                'date_of_birth' => '1990-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'admin.jpg'
            ],
            [
                'user_id' => '2222222222222',
                'email' => 'econsult.developer.fake1@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'doctor',
                'last_name' => 'two',
                'position' => 'Doctor',
                'gender' => 'Female',
                'citizen_id' => '2345678912345',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'doctor.jpg'
            ],
            [
                'user_id' => '3333333333333',
                'email' => 'econsult.developer.fake2@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'nurse',
                'last_name' => 'three',
                'position' => 'Nurse',
                'gender' => 'Female',
                'citizen_id' => '3456789123456',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'nurse.jpg'
            ],
        ]);
    }
}
