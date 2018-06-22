<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Input;
use DB;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        } catch (JWTException $exeption) {
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
        $currentUser = Auth::user();
        $role = DB::table('roles')->where('id', $currentUser->role)->first();
        return response()->json([
            'user' => [
                'id' => $currentUser->id,
                'first_name' => $currentUser->first_name,
                'last_name' => $currentUser->last_name,
                'role' => $role->role,
            ],
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function getUser(Request $request)
    {
        $token = Input::get('token');
//        echo $token;
        try {
            $currentUser = JWTAuth::toUser($token);
            $role = DB::table('roles')->where('id', $currentUser->role)->first();
            return response()->json([
                'user' => [
                    'id' => $currentUser->id,
                    'first_name' => $currentUser->first_name,
                    'last_name' => $currentUser->last_name,
                    'role' => $role->role,
                ]
            ], 200);
        } catch (JWTException $exeption) {
            return response()->json([
                'error' => 'Could not get user'
            ], 500);
        }
    }

}
