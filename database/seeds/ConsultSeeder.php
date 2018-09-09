<?php

use Illuminate\Database\Seeder;

class ConsultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("consults")->insert([
            [
                "consult_id" => "aaaaaaaaaaaaa",
                "user_id" => "3333333333333",
                "status" => "draft",
                "patient_firstname" => "Chutikan",
                "patient_lastname" => "Meeluck",
                "patient_dob" => "1986-04-14",
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
                "rec01_date" => "2014-5-10",
                "rec01_fbs" => "100",
                "rec01_bp1" => "200/90",
                "rec01_bp2" => "110/90",
                "rec01_p" => "120",
                "rec02_date" => "2014-6-10",
                "rec02_fbs" => "130/76",
                "rec02_bp1" => "110/80",
                "rec02_bp2" => "120/80",
                "rec02_p" => "70",
                "consult_complain" => "FBS >= 130 mg%",
                "consult_plan" => "Slmvas 1209 1/2 x ns",
                "consult_order" => ""
            ],
            [
                "consult_id" => "bbbbbbbbbbbbb",
                "user_id" => "3333333333333",
                "status" => "pending",
                "patient_firstname" => "Chutikan",
                "patient_lastname" => "Meeluck",
                "patient_dob" => "1986-04-14",
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
                "rec01_date" => "2014-5-10",
                "rec01_fbs" => "100",
                "rec01_bp1" => "200/90",
                "rec01_bp2" => "110/90",
                "rec01_p" => "120",
                "rec02_date" => "2014-6-10",
                "rec02_fbs" => "130/76",
                "rec02_bp1" => "110/80",
                "rec02_bp2" => "120/80",
                "rec02_p" => "70",
                "consult_complain" => "FBS >= 130 mg%",
                "consult_plan" => "Slmvas 1209 1/2 x ns",
                "consult_order" => ""
            ],
            [
                "consult_id" => "ccccccccccccc",
                "user_id" => "3333333333333",
                "status" => "done",
                "patient_firstname" => "Chutikan",
                "patient_lastname" => "Meeluck",
                "patient_dob" => "1986-04-14",
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
                "rec01_date" => "2014-5-10",
                "rec01_fbs" => "100",
                "rec01_bp1" => "200/90",
                "rec01_bp2" => "110/90",
                "rec01_p" => "120",
                "rec02_date" => "2014-6-10",
                "rec02_fbs" => "130/76",
                "rec02_bp1" => "110/80",
                "rec02_bp2" => "120/80",
                "rec02_p" => "70",
                "consult_complain" => "FBS >= 130 mg%",
                "consult_plan" => "Slmvas 1209 1/2 x ns",
                "consult_order" => "consult order test"
            ],
        ]);
    }
}
