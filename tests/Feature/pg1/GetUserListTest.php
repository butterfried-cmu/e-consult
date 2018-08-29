<?php
/**
 * Created by Teepop Ueangsawat
 * Description=> Test case for get list of user function
 * Unit Test ID=> UTC-07
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GetUserListTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testLogout()
    {
        $response = $this->json('GET', 'api/users');

        $response->assertJson([
            "users" => [
                [
                    "username" => "admin1",
                    "user_id" => "1111111111111",
                    "role" => [1],
                    "user" => [
                        "user_id" => "1111111111111",
                        "name_title" => "Mr.",
                        "first_name" => "admin",
                        "last_name" => "one",
                        "email" => "econsult.developer@gmail.com",
                        "gender" => "Male",
                        "citizen_id" => "1234567891234",
                        "date_of_birth" => "1990-01-01",
                        "contact_number" => "0804959100",
                        "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
                        "workplace" => "Kokha Hospital",
                        "image_name" => "admin.jpg"
                    ]
                ],
                [
                    "username" => "doctor1",
                    "user_id" => "2222222222222",
                    "role" => [2],
                    "user" => [
                        "user_id" => "2222222222222",
                        "name_title" => "Mrs.",
                        "first_name" => "doctor",
                        "last_name" => "two",
                        "email" => "econsult.developer.fake1@gmail.com",
                        "gender" => "Female",
                        "citizen_id" => "2345678912345",
                        "date_of_birth" => "1991-01-01",
                        "contact_number" => "0804959100",
                        "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
                        "workplace" => "Kokha Hospital",
                        "image_name" => "doctor.jpg"
                    ]
                ],
                [
                    "username" => "nurse1",
                    "user_id" => "3333333333333",
                    "role" => [3],
                    "user" => [
                        "user_id" => "3333333333333",
                        "name_title" => "Mrs.",
                        "first_name" => "nurse",
                        "last_name" => "three",
                        "email" => "econsult.developer.fake2@gmail.com",
                        "gender" => "Female",
                        "citizen_id" => "3456789123456",
                        "date_of_birth" => "1992-01-01",
                        "contact_number" => "0804959100",
                        "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
                        "workplace" => "Kokha Hospital",
                        "image_name" => "nurse.jpg"
                    ]
                ]
            ]
        ]);
    }
}
