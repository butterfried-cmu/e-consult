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
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4',
            'password' => 'required|min:4'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
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
        $user = User::with(['role', 'name_title', 'gender'])
            ->where('id', $currentUser->id)
            ->first();
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $token = Input::get('token');
        JWTAuth::invalidate($token);
        return response([
            'status' => 'success',
        ], 200);
    }

    public function getUser(Request $request)
    {
        try {
            $currentUser = JWTAuth::parseToken()->toUser();
            $user = User::with(['role', 'name_title', 'gender'])
                ->where('id', $currentUser->id)
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

}
