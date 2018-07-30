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

class GetUserByIDTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testGetExistingUser()
    {
        $response = $this->json('GET', 'api/users/2222222222222', []);

        $response->assertJson([
            "user" => [
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
            ]
        ]);
    }

    public function testGetNotExistingUser()
    {
        $response = $this->json('GET', 'api/users/212132312', []);

        $response->assertJson([
            "user_id" => ["not_exist"]
        ]);
    }
}
