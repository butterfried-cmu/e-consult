<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for updateUser function
 * Unit Test ID: UTC-06
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UpdateUserTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;


    /**
     *  All Valid (1)
     */
    public function testUpdateUserWithAllValid()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',
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
            'message' => 'successfully updated user'
        ]);
    }

    /**
     *  User Id (2)
     */
    public function testUpdateUserWithNoUserId()
    {

        $response = $this->json('POST', 'api/users/update', [
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
            'user_id' => ['required']
        ]);
    }

    public function testUpdateUserWithNotExistedUserId()
    {

        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1234',
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
            'user_id' => ['not_exist']
        ]);
    }

    /**
     *  Role (2)
     */
    public function testUpdateUserWithNoRole()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithInvalidRole()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoEmail()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithNotEmailPattern()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

            'role' => [1],
            'email' => 'econsult.developer.fake4',
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

    public function testUpdateUserWithExistedEmail()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

            'role' => [1],
            'email' => 'econsult.developer.fake2@gmail.com',
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
    public function testUpdateUserWithNoNameTitle()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithInvalidNameTitle()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoFirstName()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithNonAlphabetFirstName()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoLastName()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
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

    /**
     *  Noposition (1)
     */
    public function testUpdateUserWithNoPosition()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',
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

    public function testUpdateUserWithNonAlphabetLastName()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

            'role' => [1],
            'email' => 'econsult.developer.fake3@gmail.com',
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
    public function testUpdateUserWithNoGender()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithInvalidGender()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

//    /**
//     *  Citizen ID (5)
//     */
//    public function testUpdateUserWithNoCitizenId()
//    {
//        $response = $this->json('POST', 'api/users/update', [
//            'user_id' => '1111111111111',
//            'password' => 'admin456',
//            'password_confirmation' => 'admin456',
//            'role' => [1],
//            'email' => 'econsult.developer.fake3@gmail.com',
//            'name_title' => 'Mrs.',
//            'first_name' => 'Pim',
//            'last_name' => 'Meesang',
//'position' => 'Administrator',
//            'gender' => 'Female',
//            'date_of_birth' => '1969-02-18',
//            'contact_number' => '0869865985',
//            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
//            'workplace' => 'Kokha Hospital',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
//        ]);
//
//        $response->assertJson([
//            'citizen_id' => ['required']
//        ]);
//    }
//
//    public function testUpdateUserWithNonDigitCitizenId()
//    {
//        $response = $this->json('POST', 'api/users/update', [
//            'user_id' => '1111111111111',
//            'password' => 'admin456',
//            'password_confirmation' => 'admin456',
//            'role' => [1],
//            'email' => 'econsult.developer.fake3@gmail.com',
//            'name_title' => 'Mrs.',
//            'first_name' => 'Pim',
//            'last_name' => 'Meesang',
//'position' => 'Administrator',
//            'gender' => 'Female',
//            'citizen_id' => 'abcdef',
//            'date_of_birth' => '1969-02-18',
//            'contact_number' => '0869865985',
//            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
//            'workplace' => 'Kokha Hospital',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
//        ]);
//
//        $response->assertJson([
//            'citizen_id' => ['not_digits']
//        ]);
//    }
//
//    public function testUpdateUserWith12DigitsCitizenId()
//    {
//        $response = $this->json('POST', 'api/users/update', [
//            'user_id' => '1111111111111',
//            'password' => 'admin456',
//            'password_confirmation' => 'admin456',
//            'role' => [1],
//            'email' => 'econsult.developer.fake3@gmail.com',
//            'name_title' => 'Mrs.',
//            'first_name' => 'Pim',
//            'last_name' => 'Meesang',
//'position' => 'Administrator',
//            'gender' => 'Female',
//            'citizen_id' => '159487620659',
//            'date_of_birth' => '1969-02-18',
//            'contact_number' => '0869865985',
//            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
//            'workplace' => 'Kokha Hospital',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
//        ]);
//
//        $response->assertJson([
//            'citizen_id' => ['not_digits']
//        ]);
//    }
//
//    public function testUpdateUserWith14DigitsCitizenId()
//    {
//        $response = $this->json('POST', 'api/users/update', [
//            'user_id' => '1111111111111',
//            'password' => 'admin456',
//            'password_confirmation' => 'admin456',
//            'role' => [1],
//            'email' => 'econsult.developer.fake3@gmail.com',
//            'name_title' => 'Mrs.',
//            'first_name' => 'Pim',
//            'last_name' => 'Meesang',
//'position' => 'Administrator',
//            'gender' => 'Female',
//            'citizen_id' => '15948762065999',
//            'date_of_birth' => '1969-02-18',
//            'contact_number' => '0869865985',
//            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
//            'workplace' => 'Kokha Hospital',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
//        ]);
//
//        $response->assertJson([
//            'citizen_id' => ['not_digits']
//        ]);
//    }
//
//    public function testUpdateUserWithExistedCitizenId()
//    {
//        $response = $this->json('POST', 'api/users/update', [
//            'user_id' => '1111111111111',
//            'password' => 'admin456',
//            'password_confirmation' => 'admin456',
//            'role' => [1],
//            'email' => 'econsult.developer.fake3@gmail.com',
//            'name_title' => 'Mrs.',
//            'first_name' => 'Pim',
//            'last_name' => 'Meesang',
//'position' => 'Administrator',
//            'gender' => 'Female',
//            'citizen_id' => '1234567891234',
//            'date_of_birth' => '1969-02-18',
//            'contact_number' => '0869865985',
//            'address' => '239 Huaykaew Rd., Suthep, Muang, Chiang Mai',
//            'workplace' => 'Kokha Hospital',
//            'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAAAAAA6fptVAAAACklEQVR4nGNiAAAABgADNjd8qAAAAABJRU5ErkJggg=='
//        ]);
//
//        $response->assertJson([
//            'citizen_id' => ['not_unique']
//        ]);
//    }

    /**
     *  Date of Birth (2)
     */
    public function testUpdateUserWithNoDateOfBirth()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithNotDateDateOfBirth()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoContactNumber()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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

    public function testUpdateUserWithNotContactNumberPattern()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoAddress()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoWorkplace()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',

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
    public function testUpdateUserWithNoImage()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',
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
            'message' => 'successfully updated user'
        ]);
    }

    public function testUpdateUserWithAllValidWithJPGImage()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',
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
            'image' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD3+iiigD//2Q=='
        ]);

        $response->assertJson([
            'message' => 'successfully updated user'
        ]);
    }

    public function testUpdateUserWithNotJpgOrPng()
    {
        $response = $this->json('POST', 'api/users/update', [
            'user_id' => '1111111111111',
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
            'image' => 'image'
        ]);

        $response->assertJson([
            'image' => ['not_image']
        ]);
    }

    /**
     *  All null (1)
     */
    public function testUpdateUserWithAllNull()
    {
        $response = $this->json('POST', 'api/users/update', []);

        $response->assertJson([
            'user_id' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
            'name_title' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'contact_number' => ['required'],
            'address' => ['required'],
            'workplace' => ['required'],
        ]);
    }

}
