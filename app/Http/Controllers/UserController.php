<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $messages = [
            'required' => 'required',
            'date'     => 'date',
            'email'    => 'email',
            'numeric'  => 'num',
            'unique' => 'unique'
        ];

//        $attributes = [
//            'username',
//            'password',
//            'email',
//            'register_by',
//            'role',
//            'first_name',
//            'middle_name',
//            'last_name',
//            'gender',
//            'date_of_birth',
//            'contact_number',
//            'address'
//        ];


        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|numeric',
            'title_name' => 'required|numeric',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|numeric',
            'citizen_id' => 'required|digits:13',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required',
            'address' => 'required'
        ]);

//        $validator = $this->validate($request, [
//            'username' => 'required|unique:users',
//            'password' => 'required',
//            'email' => 'required|email|unique:users',
//            'register_by' => 'nullable|numeric',
//            'role' => 'required|numeric',
//            'first_name' => 'required',
//            'middle_name' => 'required',
//            'last_name' => 'required',
//            'gender' => 'required|numeric',
//            'date_of_birth' => 'required|date',
//            'contact_number' => 'required',
//            'address' => 'required'
//        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = new User([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'title_name' => $request->input('role'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'citizen_id' => $request->input('citizen_id'),
            'date_of_birth' => $request->input('date_of_birth'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address')
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

}
