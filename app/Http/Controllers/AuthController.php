<?php

namespace App\Http\Controllers;

use App\Account;
use App\ResetPasswordRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Input;
use DB;

class AuthController extends Controller
{

    /**
     * Allow user to authenticate to be able to use system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid Credentials'
            ], 401);
        }

        $currentUser = Auth::user();
        $user = User::where("user_id", $currentUser->user_id)->first();

        return response()->json([
            'account' => $currentUser,
            'user' => $user,
            'token' => $token
        ], 200);
    }

    /**
     * Allow user to logout from the system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = Input::get('token');

        JWTAuth::invalidate($token);
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }


    /**
     * Allow user to logout from the system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestForResettingPassword(Request $request)
    {
        $messages = [
            'required' => 'required',
            'email' => 'not email pattern',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], $messages);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if (!(User::where("email", $request->email)->exists())) {
            return response()->json([
                'error' => 'email is not exist'
            ], 200);
        }

        $user = User::where("email", $request->email)->first();
        $account = Account::where("user_id", $user->user_id)->first();

        $request_id = $this->generateRequestID();


        $baseURL = url("");
        $resetPasswordURL = $baseURL . "/#/password-reset?request_id=" . $request_id;

        Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($user, $resetPasswordURL));

        $passwordResetRequest = new ResetPasswordRequest([
            'request_id' => $request_id,
            'account_username' => $account->username,
        ]);
        $passwordResetRequest->save();

        return response()->json([
            'message' => 'Mail sent'
        ], 200);
    }

    /**
     * Allow user to logout from the system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $messages = [
            'required' => 'required',
            'confirmed' => 'not matched',
        ];

        $validator = Validator::make($request->all(), [
            'request_id' => 'required',
            'password' => 'required|confirmed',
        ], $messages);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if (!(ResetPasswordRequest::where("request_id", $request->request_id)->exists())) {
            return response()->json([
                'error' => 'request is not exist',
            ], 200);
        }

        $resetPasswordRequest = ResetPasswordRequest::where("request_id", $request->request_id)->first();

        $account = Account::where("username", $resetPasswordRequest->account_username)->first();
        $account->password = bcrypt($request->password);

        $resetPasswordRequest->delete();
        $account->save();

        return response()->json([
            'message' => 'Change password complete'
        ], 200);
    }

    /**
     * Allow user to authenticate with existed JWT token after refresh page
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function onRefresh(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->toUser();
        $user = User::where('user_id', $currentUser->user_id)->first();
        return response()->json([
            'account' => $currentUser,
            'user' => $user
        ], 200);
    }




    /**
     * ====================== Util function ======================
     */

    /**
     * Generate unique 'ResetPasswordRequest' id
     *
     * @return int id
     */
    public function generateRequestID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if ($this->requestIDExists($id)) {
            return $this->generateRequestID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'ResetPasswordRequest' id is existed in database
     *
     * @return boolean
     */
    public function requestIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return ResetPasswordRequest::where("request_id", $id)->exists();
    }

}
