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
            [
                'user_id' => '4444444444444',
                'email' => 'econsult.developer.fake3@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'doctor',
                'last_name' => 'two',
                'position' => 'Doctor',
                'gender' => 'Female',
                'citizen_id' => '1122334455667',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'doctor2.jpg'
            ],
            [
                'user_id' => '5555555555555',
                'email' => 'econsult.developer.fake4@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'doctor',
                'last_name' => 'two',
                'position' => 'Doctor',
                'gender' => 'Female',
                'citizen_id' => '2233445566778',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'doctor3.jpg'
            ],
            [
                'user_id' => '6666666666666',
                'email' => 'econsult.developer.fake5@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'doctor',
                'last_name' => 'two',
                'position' => 'Doctor',
                'gender' => 'Female',
                'citizen_id' => '3344556677889',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'doctor4.jpg'
            ],
            [
                'user_id' => '7777777777777',
                'email' => 'econsult.developer.fake6@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'doctor',
                'last_name' => 'two',
                'position' => 'Doctor',
                'gender' => 'Female',
                'citizen_id' => '4455667788991',
                'date_of_birth' => '1991-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'doctor5.jpg'
            ],
            [
                'user_id' => '8888888888888',
                'email' => 'econsult.developer.fake7@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'nurse',
                'last_name' => 'three',
                'position' => 'Nurse',
                'gender' => 'Female',
                'citizen_id' => '5566778899112',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'nurse2.jpg'
            ],
            [
                'user_id' => '9999999999999',
                'email' => 'econsult.developer.fake8@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'nurse',
                'last_name' => 'three',
                'position' => 'Nurse',
                'gender' => 'Female',
                'citizen_id' => '6677889911223',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'nurse3.jpg'
            ],
            [
                'user_id' => 'aaaaaaaaaaaaa',
                'email' => 'econsult.developer.fake9@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'nurse',
                'last_name' => 'three',
                'position' => 'Nurse',
                'gender' => 'Female',
                'citizen_id' => '7788991122334',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'nurse4.jpg'
            ],
            [
                'user_id' => 'bbbbbbbbbbbbb',
                'email' => 'econsult.developer.fake10@gmail.com',
                'name_title' => 'Mrs.',
                'first_name' => 'nurse',
                'last_name' => 'three',
                'position' => 'Nurse',
                'gender' => 'Female',
                'citizen_id' => '8899112233445',
                'date_of_birth' => '1992-01-01',
                'contact_number' => '0804959100',
                'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
                'workplace' => 'Kokha Hospital',
                'image_name' => 'nurse5.jpg'
            ],
        ]);
    }
}
