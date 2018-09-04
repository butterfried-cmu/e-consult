<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for logout function
 * Unit Test ID: UTC-02
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FindUserByKeywordTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testFindWithKeywordN()
    {
        $response = $this->json('POST', 'api/users/search', [
            'keyword' => 'n',
        ]);

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

    public function testFindWithKeywordNAndRole1()
    {
        $response = $this->json('POST', 'api/users/search', [
            'keyword' => 'n',
            'roel' => 1
        ]);

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
                ]
            ]
        ]);
    }

    public function testFindWithKeywordAsCitizenId()
    {
        $response = $this->json('POST', 'api/users/search', [
            'keyword' => '3456789123456'
        ]);

        $response->assertJson([
            "users" => [
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
