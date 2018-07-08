<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for login function
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginTest extends TestCase
{
    use WithoutMiddleware;

    public function testLoginWithValidUsernameAndPassword()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'admin1',
            'password' => 'admin1'
        ]);

        $response->assertJson([
            "account" => [
                "username" => "admin1",
                "role" => "ADMIN",
                "user_id" => "1111111111111"
            ],
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
                "image_name" => null
            ]
        ]);
    }

    public function testLoginWithInvalidUsername()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'abcdef',
            'password' => 'admin1'
        ]);

        $response->assertJson([
            "error" => "Invalid Credentials"
        ]);
    }

    public function testLoginWithInvalidPassword()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'admin1',
            'password' => '123456'
        ]);

        $response->assertJson([
            "error" => "Invalid Credentials"
        ]);
    }

    public function testLoginWithInvalidUsernameAndPassword()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'abcdef',
            'password' => '123456'
        ]);

        $response->assertJson([
            "error" => "Invalid Credentials"
        ]);
    }

    public function testLoginWithoutUsername()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'password' => '123456'
        ]);

        $response->assertJson([
            "username" => [
                "required"
            ]
        ]);
    }

    public function testLoginWithoutPassword()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'abcdef'
        ]);

        $response->assertJson([
            "password" => [
                "required"
            ]
        ]);
    }

    public function testLoginWithoutUsernameAndPassword()
    {
        $response = $this->json('POST', 'api/auth/login', []);

        $response->assertJson([
            "password" => [
                "required"
            ],
            "username" => [
                "required"
            ]
        ]);
    }
}
