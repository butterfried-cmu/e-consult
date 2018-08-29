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

class DeleteUserTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testDeleteExistingUser()
    {
        $response = $this->json('GET', 'api/users/delete/1111111111111', []);

        $response->assertJson([
            "message" => "user deleted"
        ]);
    }

    public function testDeleteNotExistingUser()
    {
        $response = $this->json('GET', 'api/users/delete/5555555555555', [
            'username' => 'admin1',
            'password' => 'admin1'
        ]);

        $response->assertJson([
            "user_id" => ["not_exist"]
        ]);
    }
}
