<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for addUser function
 */

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class AddUserTest extends TestCase
{

    public function testAddUserWithAllValid()
    {
        Storage::fake('avatars');

        $response = $this->json('POST', 'api/user/add', [
            'username' => '',
            'password' => '',
            'role' => '',

            'email' => '',
            'name_title' => '',
            'first_name' => '',
            'last_name' => '',
            'gender' => '',
            'citizen_id' => '',
            'date_of_birth' => '',
            'contact_number' => '',
            'address' => '',
            'workplace' => '',

            'image' => 'test',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'image' => ['image']
        ]);
    }

    public function testAddUserWithAllNull()
    {
        Storage::fake('avatars');

        $response = $this->json('POST', 'api/user/add', []);

        $response->assertStatus(200);

        $response->assertJson([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
            'name_title' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'citizen_id' => ['required'],
            'date_of_birth' => ['required'],
            'contact_number' => ['required'],
            'address' => ['required'],
            'workplace' => ['required'],
        ]);
    }

}
