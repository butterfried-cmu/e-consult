<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for add user function
 * Unit Test ID: UTC-05
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class AddUserTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     *  All Valid (1)
     */
    // 1
    public function testAddUserWithAllValidWithPNGImage()
    {

        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin123',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206598',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'message' => 'successfully added user'
        ]);
    }

    /**
     *  Username (5)
     */
    // 2
    public function testAddUserWithNoUsername()
    {

        $response = $this->json('POST', 'api/users/add', [
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',

//            'image' => 'test',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'username' => ['required']
        ]);
    }

    // 3
    public function testAddUserWithExistedUsername()
    {

        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin1',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',

//            'image' => 'test',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'username' => ['not_unique']
        ]);
    }

    // 4
    public function testAddUserWithUsernameContainSymbol()
    {

        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin!@#',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',

//            'image' => 'test',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'username' => ['not_alpha_num']
        ]);
    }

    // 5
    public function testAddUserWithUsernameLessThan4Characters()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'abc',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'username' => ['min']
        ]);
    }

    // 6
    public function testAddUserWithUsernameMoreThan30Characters()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => '0123456789012345678901234567890',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'username' => ['max']
        ]);
    }

    /**
     *  Password (5)
     */
    // 7
    public function testAddUserWithNoPassword()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',

//            'image' => 'test',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'password' => ['required']
        ]);
    }

    public function testAddUserWithNoPasswordConfirmation()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'password' => ['not_confirmed']
        ]);
    }

    public function testAddUserWithWrongPasswordConfirmation()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin123',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'password' => ['not_confirmed']
        ]);
    }

    public function testAddUserWithPasswordLessThan4Characters()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => '123',
            'password_confirmation' => '123',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'password' => ['min']
        ]);
    }

    // 11
    public function testAddUserWithPasswordMoreThan30Characters()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => '0123456789012345678901234567890',
            'password_confirmation' => '0123456789012345678901234567890',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'password' => ['max']
        ]);
    }

    /**
     *  Role (2)
     */
    public function testAddUserWithNoRole()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'role' => ['required']
        ]);
    }

    // 13
    public function testAddUserWithInvalidRole()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => '1234',
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'role' => ['not_role']
        ]);
    }

    /**
     *  Email (3)
     */
    public function testAddUserWithNoEmail()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'email' => ['required']
        ]);
    }

    public function testAddUserWithNotEmailPattern()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake5',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'email' => ['not_email']
        ]);
    }

    // 16
    public function testAddUserWithExistedEmail()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake1@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'email' => ['not_unique']
        ]);
    }

    /**
     *  Name Title (2)
     */
    public function testAddUserWithNoNameTitle()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'name_title' => ['required']
        ]);
    }

    // 18
    public function testAddUserWithInvalidNameTitle()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => '1234',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'name_title' => ['not_title']
        ]);
    }

    /**
     *  First Name (2)
     */
    public function testAddUserWithNoFirstName()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'first_name' => ['required']
        ]);
    }

    // 20
    public function testAddUserWithNonAlphabetFirstName()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim76',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'first_name' => ['not_alpha']
        ]);
    }

    /**
     *  Last Name (2)
     */
    public function testAddUserWithNoLastName()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'last_name' => ['required']
        ]);
    }

    // 22
    public function testAddUserWithNonAlphabetLastName()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang76',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'last_name' => ['not_alpha']
        ]);
    }

    /**
     *  Gender (2)
     */
    public function testAddUserWithNoGender()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'gender' => ['required']
        ]);
    }

    // 24
    public function testAddUserWithInvalidGender()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => '1234',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'gender' => ['not_gender']
        ]);
    }

    /**
     *  Citizen ID (5)
     */
    public function testAddUserWithNoCitizenId()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'citizen_id' => ['required']
        ]);
    }

    public function testAddUserWithNonDigitCitizenId()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => 'abcdef',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'citizen_id' => ['not_digits']
        ]);
    }

    public function testAddUserWith12DigitsCitizenId()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '159487620659',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'citizen_id' => ['not_digits']
        ]);
    }

    public function testAddUserWith14DigitsCitizenId()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '15948762065980',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'citizen_id' => ['not_digits']
        ]);
    }

    // 29
    public function testAddUserWithExistedCitizenId()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1234567891234',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'citizen_id' => ['not_unique']
        ]);
    }

    /**
     *  Date of Birth (2)
     */
    public function testAddUserWithNoDateOfBirth()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'date_of_birth' => ['required']
        ]);
    }

    // 31
    public function testAddUserWithNotDateDateOfBirth()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => 'abcdef',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'date_of_birth' => ['not_date']
        ]);
    }

    /**
     *  Contact Number (2)
     */
    public function testAddUserWithNoContactNumber()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'contact_number' => ['required']
        ]);
    }

    // 33
    public function testAddUserWithNotContactNumberPattern()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '1234',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'contact_number' => ['not_valid_pattern']
        ]);
    }

    /**
     *  Address (1)
     */
    // 34
    public function testAddUserWithNoAddress()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'address' => ['required']
        ]);
    }

    /**
     *  Workplace (1)
     */
    // 35
    public function testAddUserWithNoWorkplace()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'workplace' => ['required']
        ]);
    }

    /**
     *  Image (3)
     */
    // 36
    public function testAddUserWithNoImage()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin234',
            'password' => 'admin234',
            'password_confirmation' => 'admin234',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206597',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
        ]);

        $response->assertJson([
            'message' => 'successfully added user'
        ]);
    }

    // 37
    public function testAddUserWithAllValidWithJPGImage()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin123',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206598',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD3+iiigD//2Q=='
        ]);

        $response->assertJson([
            'message' => 'successfully added user'
        ]);
    }

    // 38
    public function testAddUserWithTxtFile()
    {
        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'position' => 'Administrator',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:text/plain;base64,MQ=='
        ]);

        $response->assertJson([
            'image' => ['not_image']
        ]);
    }

    /**
     *  All null (1)
     */
    // 39
    public function testAddUserWithAllNull()
    {
        $response = $this->json('POST', 'api/users/add', []);

        $response->assertJson([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
            'name_title' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'position' => ['required'],
            'gender' => ['required'],
            'citizen_id' => ['required'],
            'date_of_birth' => ['required'],
            'contact_number' => ['required'],
            'address' => ['required'],
            'workplace' => ['required'],
        ]);
    }

    /**
     *  No Position (1)
     */
    // 40
    public function testAddUserWithNoPosition()
    {

        $response = $this->json('POST', 'api/users/add', [
            'username' => 'admin123',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'gender' => 'Female',
            'citizen_id' => '1594876206598',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
        ]);

        $response->assertJson([
            'position' => ['required']
        ]);
    }


    // TOTAL: 40
}
