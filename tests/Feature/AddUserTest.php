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
    use WithoutMiddleware;


    /**
     *  All Valid (1)
     */
    public function testAddUserWithAllValid()
    {

        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin123',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'role' => 'ADMIN',
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
            'message' => 'Successfully created user'
        ]);
    }

    /**
     *  Username (3)
     */
    public function testAddUserWithNoUsername()
    {

        $response = $this->json('POST', 'api/user/add', [
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithExistedUsername()
    {

        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin1',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithUsernameContainSymbol()
    {

        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin!@#',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    /**
     *  Password (3)
     */
    public function testAddUserWithNoPassword()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    /**
     *  Role (2)
     */
    public function testAddUserWithNoRole()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithInvalidRole()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => '1234',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake4',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithExistedEmail()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake1@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithInvalidNameTitle()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => '1234',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'last_name' => 'Meesang',
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

    public function testAddUserWithNonAlphabetFirstName()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim76',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
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

    public function testAddUserWithNonAlphabetLastName()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang76',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithInvalidGender()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'gender' => 'Female',
            'citizen_id' => '15948762065999',
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

    public function testAddUserWithExistedCitizenId()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithNotDateDateOfBirth()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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

    public function testAddUserWithNotContactNumberPattern()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
    public function testAddUserWithNoAddress()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
    public function testAddUserWithNoWorkplace()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
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
     *  Image (2)
     */
    public function testAddUserWithNoImage()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin234',
            'password' => 'admin234',
            'password_confirmation' => 'admin234',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake4@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'gender' => 'Female',
            'citizen_id' => '1594876206597',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
        ]);

        $response->assertJson([
            'message' => 'Successfully created user'
        ]);
    }

    public function testAddUserWithNotJpgOrPng()
    {
        $response = $this->json('POST', 'api/user/add', [
            'username' => 'admin456',
            'password' => 'admin456',
            'password_confirmation' => 'admin456',
            'role' => 'ADMIN',
            'email' => 'econsult.developer.fake5@gmail.com',
            'name_title' => 'Mrs.',
            'first_name' => 'Pim',
            'last_name' => 'Meesang',
            'gender' => 'Female',
            'citizen_id' => '1594876206599',
            'date_of_birth' => '1969-02-18',
            'contact_number' => '0869865985',
            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
            'workplace' => 'Kokha Hospital',
            'image' => 'image'
        ]);

        $response->assertJson([
            'image' => ['not_image']
        ]);
    }

    /**
     *  All null (1)
     */
    public function testAddUserWithAllNull()
    {
        $response = $this->json('POST', 'api/user/add', []);

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
