<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for update password function
 * Unit Test ID: UTC-03
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdatePasswordTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testUpdatePasswordWithAllValidData()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'request_id' => '1234567891234',
            'password' => 'admin1',
            'password_confirmation' => 'admin1'
        ]);

        $response->assertJson([
            'message' => 'change password completed'
        ]);
    }

    public function testUpdatePasswordWithNoPassword()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'request_id' => '1234567891234',
            'password_confirmation' => 'admin1'
        ]);

        $response->assertJson([
            "password"=> ["required"]
        ]);
    }

    public function testUpdatePasswordWithNoPasswordConfirmation()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'request_id' => '1234567891234',
            'password' => 'admin1'
        ]);

        $response->assertJson([
            "password"=> ["not_confirmed"]
        ]);
    }

    public function testUpdatePasswordWithNoPasswordAndPasswordConfirmation()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'request_id' => '1234567891234'
        ]);

        $response->assertJson([
            "password"=> ["required"]
        ]);
    }

    public function testUpdatePasswordWithNoRequestId()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'password' => 'admin1',
            'password_confirmation' => 'admin1'
        ]);

        $response->assertJson([
            'error' => 'request does not exist'
        ]);
    }

    public function testUpdatePasswordWithInvalidRequestId()
    {
        $response = $this->json('POST', 'api/auth/password/reset', [
            'request_id' => 'abcdef',
            'password' => 'admin1',
            'password_confirmation' => 'admin1'
        ]);

        $response->assertJson([
            'error' => 'request does not exist'
        ]);
    }

    public function testUpdatePasswordWithNoInputData()
    {
        $response = $this->json('POST', 'api/auth/password/reset', []);

        $response->assertJson([
            'error' => 'request does not exist'
        ]);
    }
}
