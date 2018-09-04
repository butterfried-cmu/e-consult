<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for reset password request function
 * Unit Test ID: UTC-04
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ResetPasswordRequestTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testResetPasswordRequestWithValidEmail()
    {
        $response = $this->json('POST', 'api/auth/password/request', [
            'email' => 'econsult.developer@gmail.com',
        ]);

        $response->assertJson([
            'message' => 'mail sent'
        ]);
    }

    public function testResetPasswordRequestWithInvalidEmail()
    {
        $response = $this->json('POST', 'api/auth/password/request', [
            'email' => 'econsult.developer.fake6@gmail.com',
        ]);

        $response->assertJson([
            'error' => 'email is not exist'
        ]);
    }

    public function testResetPasswordRequestWithNoEmail()
    {
        $response = $this->json('POST', 'api/auth/password/request', [
            'email' => '',
        ]);

        $response->assertJson([
            'email' => ['required']
        ]);
    }

    public function testResetPasswordRequestWithInvalidEmailFormat()
    {
        $response = $this->json('POST', 'api/auth/password/request', [
            'email' => 'abcdef',
        ]);

        $response->assertJson([
            'email' => ['not_email']
        ]);
    }
}
