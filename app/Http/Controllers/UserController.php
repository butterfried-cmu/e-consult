<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Namshi\JOSE\JWT;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'date' => 'date',
            'email' => 'email',
            'numeric' => 'num',
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
            'username' => 'required|unique:users|alpha_num',
            'password' => 'required|confirmed',
            'email' => 'required|email|unique:users',
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
//        $token = Input::get('id');
//        echo $token;
        try {
//            $currentUser = JWTAuth::toUser($token);
            $currentUser = JWTAuth::parseToken()->toUser();
            $user = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role')
                ->join('name_titles', 'name_titles.id', '=', 'users.name_title')
                ->join('genders', 'genders.id', '=', 'users.gender')
                ->where('users.id', $currentUser->id)
                ->select(
                    'users.id',
                    'users.username',
                    'users.email',
                    'roles.role',
                    'name_titles.name_title',
                    'users.first_name',
                    'users.last_name',
                    'genders.gender',
                    'users.citizen_id',
                    'users.date_of_birth',
                    'users.contact_number',
                    'users.address',
                    'users.workplace',
                    'users.created_at',
                    'users.updated_at'
                )
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

    public function getFormData(Request $request)
    {
        try {
            $roles = DB::table('roles')->get();
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
