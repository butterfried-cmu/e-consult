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

class LogoutTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testLogout()
    {
        $response = $this->json('POST', 'api/auth/login', [
            'username' => 'admin1',
            'password' => 'admin1'
        ]);
        $login_obj = $response->getOriginalContent();
        $token = $login_obj['token'];
        $response = $this->json('POST', 'api/auth/logout?token='.$token, []);

        $response->assertJson([
            "status" => "success"
        ]);
    }
}
