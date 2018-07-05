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
            'user' => $user,
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

}
