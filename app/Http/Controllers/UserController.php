<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;

/*
 * addUser -> postUser
 * getUser
 * getUsers
 * getFormData
 */

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'date' => 'not date pattern',
            'email' => 'not email pattern',
            'numeric' => 'not numeric',
            'unique' => 'already exist',
            'confirmed' => 'not matched',

        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|alpha_num',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'role' => 'required|numeric',
            'name_title' => 'required|numeric',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|numeric',
            'citizen_id' => 'required|digits:13|unique:users',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'workplace' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = new User([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'name_title' => $request->input('name_title'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'citizen_id' => $request->input('citizen_id'),
            'date_of_birth' => $request->input('date_of_birth'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'workplace' => $request->input('workplace')
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function getUser(Request $request)
    {
        $id = Input::get('id');
//        echo $token;
        try {
            $user = User::with(['role','name_title','gender'])
                ->where('id', $id)
                ->first();
            return response()->json([
                'user' => $user
            ], 200);
        } catch (JWTException $exeption) {
            return response()->json([
                'error' => 'Could not get user'
            ], 500);
        }
    }

    public function getUsers(Request $request)
    {
//        $token = Input::get('id');
//        echo $token;
        try {
            $users = User::with(['role','name_title','gender'])->get();
            return response()->json([
                'allUsers' => $users
            ], 200);
        } catch (JWTException $exeption) {
            return response()->json([
                'error' => 'Could not get users'
            ], 500);
        }
    }

    public function getFormData(Request $request)
    {
        try {
            $roles = Role::get();
            $genders = DB::table('genders')->get();
            $name_titles = DB::table('name_titles')->get();
            return response()->json([
                'form' => [
                    'roles' => $roles,
                    'genders' => $genders,
                    'name_titles' => $name_titles
                ]

            ], 200);
        } catch (JWTException $exeption) {
            return response()->json([
                'error' => 'Could not get user'
            ], 500);
        }
    }


}
