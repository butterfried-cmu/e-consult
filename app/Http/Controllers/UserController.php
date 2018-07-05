<?php

namespace App\Http\Controllers;

use App\Account;
use AppHelper;
use App\Role;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;
use Image;
use Input;

/*
 * addUser -> postUser
 * getUser
 * getUsers
 * getFormData
 */

class UserController extends Controller
{

    /**
     * Get 'User' information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'exists' => 'not exist',
        ];

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users',
            ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

            $user = User::find($request->user_id);
            return response()->json([
                'user' => $user
            ], 200);

    }


    /**
     * Delete 'User' and 'Account' from the database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'exists' => 'not exist',
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

            $user = User::find($request->user_id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted',
            ], 200);

    }


    /**
     * Get list 'User' with information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request)
    {
            $users = User::get();
            return response()->json([
                'users' => $users
            ], 200);
    }


    /**
     * Create 'User' and Add 'User' into database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            'username' => 'required|unique:accounts|alpha_num',
            'password' => 'required|confirmed',
            'role' => 'required|alpha',

            'email' => 'required|email',
            'name_title' => 'required',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required',
            'citizen_id' => 'required|digits:13|unique:users',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'workplace' => 'required',

            'image_name' => 'image',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $userId = $this->generateUserID();
//        $accountId = uniqid();

        $name = '';

        if ($request->get('image')) {
//            echo $request->get('image');
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/users/') . $name);
        }

        $user = new User([
            'user_id' => $userId,
            'email' => $request->input('email'),
            'name_title' => $request->input('name_title'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'citizen_id' => $request->input('citizen_id'),
            'date_of_birth' => $request->input('date_of_birth'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'workplace' => $request->input('workplace'),
            'image_name' => $name,
        ]);

        $account = new Account([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'user_id' => $userId,
        ]);

        $user->save();
        $account->save();

        return response()->json([
            'message' => 'Successfully created user'
        ], 201);
    }


    /**
     * Update 'User' with information into database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'date' => 'not date pattern',
            'email' => 'not email pattern',
            'numeric' => 'not numeric',
            'unique' => 'already exist',
            'confirmed' => 'not matched',
            'exists' => 'not exist',
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users',

            'email' => 'required|email',
            'name_title' => 'required|numeric',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|numeric',
//            'citizen_id' => 'required|digits:13|unique:users',
//            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'workplace' => 'required',

            'image_name' => 'image',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if ($request->get('image')) {
            echo $request->get('image');
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/') . $name);
        }

        $user = User::find($request->user_id);

        $user->email = $request->input('email');
        $user->name_title = $request->input('name_title');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->gender = $request->input('gender');
//        $user->citizen_id = $request->input('citizen_id');
//        $user->date_of_birth = $request->input('date_of_birth');
        $user->contact_number = $request->input('contact_number');
        $user->address = $request->input('address');
        $user->workplace = $request->input('workplace');
        $user->image_name = $request->input('image_name');
        $user->email = $request->input('email');

        $user->save();

        return response()->json([
            'message' => 'Successfully update user'
        ], 201);
    }


    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateUserID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if ($this->userIDExists($id)) {
            return $this->generateUserID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function userIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return User::where('user_id', $id)->exists();
    }
}
