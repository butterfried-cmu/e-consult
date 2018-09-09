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


class EditConsultTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     *  All Valid (1)
     */
    public function testEditConsultWithAllValidInput()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoFirstname()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoLastname()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoDateOfBirth()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoGender()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoAddress()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoPrimaryDoctor()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithAllHealthCondition()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNoConsultComplain()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', [
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

    public function testEditConsultWithNotExistConsult()
    {
        $response = $this->json('POST', 'api/consults/zzzzzzzzzzzzz', [
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
            'consult_id' => ['not_exist']
        ]);
    }

    public function testEditConsultWithNotDraftConsult()
    {
        $response = $this->json('POST', 'api/consults/ccccccccccccc', [
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
            'error' => 'not_draft_consult'
        ]);
    }

    public function testEditConsultWithNoConsultInput()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa', []);

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
