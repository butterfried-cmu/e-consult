<?php

namespace App\Http\Controllers;

use App\Consult;
use App\User;
use Illuminate\Http\Request;

use Validator;
use App\Rules\ValidImage;
use PDF;

class ConsultController extends Controller
{
    /**
     * Get 'User' information
     *
     * @param $consult_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsultById($consult_id)
    {
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id]), [
            'consult_id' => 'required|exists:consults',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

//        $user = User::find($request->user_id);
        $consult = Consult::with(['user'])->where('consult_id', $consult_id)->first();

        return response()->json([
            'consult' => $consult
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

    }

    public function postCreateConsult()
    {
        $request = request();

        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge($request->all()), [
            'user_id' => 'required|exists:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'primary_doctor' => 'required',
            'health_condition' => 'required',
            'med_xd',
            'med_bw',
            'med_bmi',
            'med_t',
            'med_fbs',
            'med_cr',
            'med_clearance',
            'med_stage',
            'rec01_date',
            'rec01_fbs',
            'rec01_bp1',
            'rec01_bp2',
            'rec01_p',
            'rec02_date',
            'rec02_fbs',
            'rec02_bp1',
            'rec02_bp2',
            'rec02_p',
            'consult_complain' => 'required',
            'consult_plan'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consult_id = $this->generateConsultID();

        $consult = new Consult([
            'consult_id' => $consult_id,
            'status' => 'draft',
            'user_id' => $request->input('user_id'),
            'patient_firstname' => $request->input('first_name'),
            'patient_lastname' => $request->input('last_name'),
            'patient_dob' => $request->input('dob'),
            'patient_gender' => $request->input('gender'),
            'patient_address' => $request->input('address'),
            'primary_doctor' => $request->input('primary_doctor'),
            'health_condition' => $request->input('health_condition'),
            'med_dx' => $request->input('med_dx'),
            'med_bw' => $request->input('med_bw'),
            'med_bmi' => $request->input('med_bmi'),
            'med_t' => $request->input('med_t'),
            'med_fbs' => $request->input('med_fbs'),
            'med_cr' => $request->input('med_cr'),
            'med_clearance' => $request->input('med_clearance'),
            'med_stage' => $request->input('med_stage'),
            'rec01_date' => $request->input('rec01_date'),
            'rec01_fbs' => $request->input('rec01_fbs'),
            'rec01_bp1' => $request->input('rec01_bp1'),
            'rec01_bp2' => $request->input('rec01_bp2'),
            'rec01_p' => $request->input('rec01_p'),
            'rec02_date' => $request->input('rec02_date'),
            'rec02_fbs' => $request->input('rec02_fbs'),
            'rec02_bp1' => $request->input('rec02_bp1'),
            'rec02_bp2' => $request->input('rec02_bp2'),
            'rec02_p' => $request->input('rec02_p'),
            'consult_complain' => $request->input('consult_complain'),
            'consult_plan' => $request->input('consult_plan')
        ]);
        $consult->save();

        return response()->json([
            'message' => 'success'
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function postEditConsult($consult_id)
    {
        $request = request();

        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id],$request->all()), [
            'consult_id' => 'exists:consults',
            'patient_firstname' => 'required',
            'patient_lastname' => 'required',
            'patient_dob' => 'required',
            'patient_gender' => 'required',
            'patient_address' => 'required',
            'primary_doctor' => 'required',
            'health_condition' => 'required',
            'med_xd',
            'med_bw',
            'med_bmi',
            'med_t',
            'med_fbs',
            'med_cr',
            'med_clearance',
            'med_stage',
            'rec01_date',
            'rec01_fbs',
            'rec01_bp1',
            'rec01_bp2',
            'rec01_p',
            'rec02_date',
            'rec02_fbs',
            'rec02_bp1',
            'rec02_bp2',
            'rec02_p',
            'consult_complain' => 'required',
            'consult_plan'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consult = Consult::find($consult_id);

        if($consult->status != "draft"){
            return response()->json([
                'error' => 'not_draft_consult'
            ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        }

        $consult->patient_firstname = $request->input('patient_firstname');
        $consult->patient_lastname = $request->input('patient_lastname');
        $consult->patient_dob = $request->input('patient_dob');
        $consult->patient_gender = $request->input('patient_gender');
        $consult->patient_address = $request->input('patient_address');
        $consult->primary_doctor = $request->input('primary_doctor');
        $consult->health_condition = $request->input('health_condition');
        $consult->med_dx = $request->input('med_dx');
        $consult->med_bw = $request->input('med_bw');
        $consult->med_bmi = $request->input('med_bmi');
        $consult->med_t = $request->input('med_t');
        $consult->med_fbs = $request->input('med_fbs');
        $consult->med_cr = $request->input('med_cr');
        $consult->med_clearance = $request->input('med_clearance');
        $consult->med_stage = $request->input('med_stage');
        $consult->rec01_date = $request->input('rec01_date');
        $consult->rec01_fbs = $request->input('rec01_fbs');
        $consult->rec01_bp1 = $request->input('rec01_bp1');
        $consult->rec01_bp2 = $request->input('rec01_bp2');
        $consult->rec01_p = $request->input('rec01_p');
        $consult->rec02_date = $request->input('rec02_date');
        $consult->rec02_fbs = $request->input('rec02_fbs');
        $consult->rec02_bp1 = $request->input('rec02_bp1');
        $consult->rec02_bp2 = $request->input('rec02_bp2');
        $consult->rec02_p = $request->input('rec02_p');
        $consult->consult_complain = $request->input('consult_complain');
        $consult->consult_plan = $request->input('consult_plan');

        $consult->save();

        return response()->json([
            'message' => 'success'
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

    }

    public function getDeleteDraftConsult($consult_id){
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id]), [
            'consult_id' => 'required|exists:consults',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consult = Consult::find($consult_id);

        if($consult->status != "draft"){
            return response()->json([
                'error' => 'not_draft_consult'
            ], 200);
        }

        $consult->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function getSendDraftConsult($consult_id){
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id]), [
            'consult_id' => 'required|exists:consults',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consult = Consult::find($consult_id);

        if($consult->status != "draft"){
            return response()->json([
                'error' => 'not_draft_consult'
            ], 200);
        }

        $consult->status = "pending";
        $consult->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function postReplyConsult($consult_id){
        $request = request();

        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id],$request->all()), [
            'consult_id' => 'required|exists:consults',
            'consult_order' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consult = Consult::find($consult_id);

        if($consult->status != "pending"){
            return response()->json([
                'error' => 'not_pending_consult'
            ], 200);
        }

        $consult->consult_order = $request->consult_order;
        $consult->status = 'done';
        $consult->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function getDraftConsultList($user_id){
        $consults = Consult::where(['status' => 'draft', 'user_id' => $user_id])->get();
        foreach ($consults as $consult){
            $creator = User::where('user_id', $consult->user_id)->first();
            $consult->created_by = $creator;
        }
        return response()->json([
            'consults' => $consults
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function getDoneConsultList(){
        $consults = Consult::where(['status' => 'done'])->get();
        foreach ($consults as $consult){
            $creator = User::where('user_id', $consult->user_id)->first();
            $consult->created_by = $creator;
        }
        return response()->json([
            'consults' => $consults
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function getPendingConsultList(){
        $consults = Consult::where(['status' => 'pending'])->get();
        foreach ($consults as $consult){
            $creator = User::where('user_id', $consult->user_id)->first();
            $consult->created_by = $creator;
        }
        return response()->json([
            'consults' => $consults
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function postFindConsultByKeyword(){
        $request = request();

        $messages = [
            'required' => 'required'
        ];

        $validator = Validator::make(array_merge($request->all()), [
            'keyword' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $consults = Consult::where('status','done')
//            ->where()
            ->where(function($query) use ($request) {
                $query->where('patient_firstname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('patient_lastname', 'like', '%' . $request->keyword . '%');
            })
            ->get();

        foreach ($consults as $consult){
            $creator = User::where('user_id', $consult->user_id)->first();
            $consult->created_by = $creator;
        }

        return response()->json([
            'consults' => $consults
        ], 200, [],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function printConsultForm()
    {
        // Fetch all customers from database
//        $data = Customer::get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('consultFormTemplate');
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(public_path().'\storage\consult\consult.pdf');
        // Finally, you can download the file using download function
        return asset('storage/consult.pdf');
    }


    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateConsultID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if ($this->consultIDExists($id)) {
            return $this->generateConsultID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function consultIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Consult::where('consult_id', $id)->exists();
    }
}
