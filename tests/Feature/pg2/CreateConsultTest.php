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


class CreateConsultTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     *  All Valid (1)
     */
    public function testCreateConsultWithAllValidInput()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'message' => 'success'
        ]);
    }

    public function testCreateConsultWithNoFirstname()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'first_name' => ['required']
        ]);
    }

    public function testCreateConsultWithNoLastname()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'last_name' => ['required']
        ]);
    }

    public function testCreateConsultWithNoDateOfBirth()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'dob' => ['required']
        ]);
    }

    public function testCreateConsultWithNoGender()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'gender' => ['required']
        ]);
    }

    public function testCreateConsultWithNoAddress()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'address' => ['required']
        ]);
    }

    public function testCreateConsultWithNoPrimaryDoctor()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'primary_doctor' => ['required']
        ]);
    }

    public function testCreateConsultWithAllHealthCondition()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "first_name" => "patient",
            "last_name" => "test",
            "dob" => "2012-5-10",
            "gender" => "Male",
            "address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_complain" => "FBS >= 130 mg%",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'health_condition' => ['required']
        ]);
    }

    public function testCreateConsultWithNoConsultComplain()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
            "patient_firstname" => "patient",
            "patient_lastname" => "test",
            "patient_dob" => "2012-5-10",
            "patient_gender" => "Male",
            "patient_address" => "239 Huaykaew Rd., Suthep, Muang, Chiang Mai",
            "primary_doctor" => "Dr. James Gordon",
            "health_condition" => "diabetes",
            "med_hn" => "61223",
            "med_dx" => "DM",
            "med_bw" => "65",
            "med_bmi" => "26.6",
            "med_t" => "37",
            "med_fbs" => "100",
            "med_cr" => "0.43",
            "med_clearance" => "122.1",
            "med_stage" => "1",
            "rec01_date" => "2014/5/10",
            "rec01_fbs" => "100",
            "rec01_bp1" => "200/90",
            "rec01_bp2" => "110/90",
            "rec01_p" => "120",
            "rec02_date" => "2014/6/10",
            "rec02_fbs" => "130/76",
            "rec02_bp1" => "110/80",
            "rec02_bp2" => "120/80",
            "rec02_p" => "70",
            "consult_plan" => "Slmvas 1209 1/2 x ns"
        ]);

        $response->assertJson([
            'consult_complain' => ['required']
        ]);
    }

    public function testCreateConsultWithNoConsultInput()
    {
        $response = $this->json('POST', 'api/consults', [
            "user_id" => "3333333333333",
        ]);

        $response->assertJson([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'primary_doctor' => ['required'],
            'health_condition' => ['required'],
            'consult_complain' => ['required']
        ]);
    }

}
