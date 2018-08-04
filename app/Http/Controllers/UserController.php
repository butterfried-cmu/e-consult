<?php

namespace App\Http\Controllers;

use App\Account;
use App\Rules\ValidNameTitle;
use App\Rules\ValidRole;
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
use App\Rules\ValidImage;
use App\Rules\ValidGender;

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
    public function getUserById($user_id)
    {
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|exists:users',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

//        $user = User::find($request->user_id);
        $user = Account::with(['user'])->where('user_id', $user_id)->first();

        $query = "SELECT role_id FROM accounts_roles WHERE accounts_roles.account_username = '$user->username'";
        $role_array = DB::SELECT($query);

        $role_list = [];

        foreach ($role_array as $role) {
            array_push($role_list, $role->role_id);
        }

        $user->role = $role_list;

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
    public function deleteUser($user_id)
    {
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|exists:users',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $account = Account::where('user_id',$user_id);
        $account->delete();

        $user = User::find($user_id);
        $user->delete();
        return response()->json([
            'message' => 'user deleted',
        ], 200);

    }


    /**
     * Get list 'User' with information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserList(Request $request)
    {
        $users = Account::with(['user'])->get();

        foreach ($users as $user) {
            $query = "SELECT role_id FROM accounts_roles WHERE accounts_roles.account_username = '$user->username'";
            $role_array = DB::SELECT($query);

            $role_list = [];

            foreach ($role_array as $role) {
                array_push($role_list, $role->role_id);
            }

            $user->role = $role_list;
        }

        return response()->json([
            'users' => $users
        ], 200);
    }

    /**
     * Get list 'User' with information by the input keyword
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersByKeyword(Request $request)
    {
        $keyword = $request->keyword;
        $role = $request->role;

        $query = "SELECT * FROM accounts INNER JOIN users ON users.user_id = accounts.user_id JOIN accounts_roles ON accounts_roles.account_username = accounts.username ";
        $query .= " WHERE(users.first_name LIKE '%$keyword%' OR users.last_name LIKE '%$keyword%' OR users.citizen_id LIKE '%$keyword%') ";
        if ($role != '') {
            $query .= " AND accounts_roles.role_id = $role ";
        }
        $query .= " GROUP BY accounts.username ";
        $users = DB::SELECT($query);
//        $users = Account::with(['user'])->get()->where('','like',$request->keyword);

        $new_user_list = [];

        foreach ($users as $user) {

            $user_temp = new \stdClass;
            $user_temp->username = $user->username;
            $user_temp->user_id = $user->user_id;

            $user_temp->user = new \stdClass();
            $user_temp->user->user_id = $user->user_id;
            $user_temp->user->name_title = $user->name_title;
            $user_temp->user->first_name = $user->first_name;
            $user_temp->user->last_name = $user->last_name;
            $user_temp->user->email = $user->email;
            $user_temp->user->gender = $user->gender;
            $user_temp->user->citizen_id = $user->citizen_id;
            $user_temp->user->date_of_birth = $user->date_of_birth;
            $user_temp->user->contact_number = $user->contact_number;
            $user_temp->user->address = $user->address;
            $user_temp->user->workplace = $user->workplace;
            $user_temp->user->image_name = $user->image_name;


            $query = "SELECT role_id FROM accounts_roles WHERE accounts_roles . account_username = '$user->username'";
            $role_array = DB::SELECT($query);

            $role_list = [];

            foreach ($role_array as $role) {
                array_push($role_list, $role->role_id);
            }

            $user_temp->role = $role_list;

            array_push($new_user_list, $user_temp);
        }

        return response()->json([
            'users' => $new_user_list
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
            'date' => 'not_date',
            'email' => 'not_email',
            'numeric' => 'not_numeric',
            'unique' => 'not_unique',
            'confirmed' => 'not_confirmed',
            'alpha_num' => 'not_alpha_num',
            'alpha' => 'not_alpha',
            'digits' => 'not_digits',
            'regex' => 'not_valid_pattern',
            'min' => 'min',
            'max' => 'max'
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:30|alpha_num|unique:accounts',
            'password' => 'required|min:4|max:30|confirmed',
            'role' => ['required', new ValidRole()],

            'email' => 'required|email|unique:users',
            'name_title' => ['required', new ValidNameTitle()],
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'position' => 'required',
            'gender' => ['required', new ValidGender()],
            'citizen_id' => 'required|digits:13|unique:users',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'workplace' => 'required',

//            'image' => 'is_png',
            'image' => [new ValidImage],
//            'image' => array('regex:/^data:image\/(?:gif|png|jpeg|bmp|webp)(?:;charset=utf-8)?;base64,(?:[A-Za-z0-9]|[+/])+={0,2}/'),
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
            'position' => $request->input('position'),
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
            'user_id' => $userId,
        ]);

        $roles = $request->input('role');
        foreach ($roles as $role) {
            DB::table('accounts_roles')->insert([
                    'account_username' => $request->input('username'),
                    'role_id' => $role
                ]
            );
        }

        $user->save();
        $account->save();

        return response()->json([
            'message' => 'successfully added user'
        ], 201);
    }


    /**
     * Update 'User' with information into database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * ++ updateUser have more custom validate after Validator checked
     */
    public function updateUser(Request $request)
    {
        $messages = [
            'required' => 'required',
            'date' => 'not_date',
            'email' => 'not_email',
            'numeric' => 'not_numeric',
            'unique' => 'not_unique',
            'confirmed' => 'not_confirmed',
            'alpha_num' => 'not_alpha_num',
            'alpha' => 'not_alpha',
            'digits' => 'not_digits',
            'regex' => 'not_valid_pattern',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make($request->all(), [
//            'username' => 'required|unique:accounts|alpha_num',
//            'password' => 'required|confirmed',
            'user_id' => 'required|exists:users',

            'role' => ['required', new ValidRole()],

            'email' => 'required|email',
            'name_title' => ['required', new ValidNameTitle()],
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'position' => 'required',
            'gender' => ['required', new ValidGender()],
//            'citizen_id' => 'required|digits:13|unique:users',
            'date_of_birth' => 'required|date',
            'contact_number' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'workplace' => 'required',

//            'image' => 'is_png',
            'image' => [new ValidImage],
//            'image' => array('regex:/^data:image\/(?:gif|png|jpeg|bmp|webp)(?:;charset=utf-8)?;base64,(?:[A-Za-z0-9]|[+/])+={0,2}/'),
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        // Check that the input email is not exist except from the updated user
        $count = User::where('email', $request->get('email'))->whereNotIn('user_id', [$request->input('user_id')])->count();
        if ($count >= 1) {
            return response()->json([
                'email' => [
                    'not_unique'
                ]
            ], 200);
        }

        if ($request->get('image')) {
            // echo $request->get('image');
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/') . $name);
        }

        $user = User::find($request->input('user_id'));

        $user->email = $request->input('email');
        $user->name_title = $request->input('name_title');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->position = $request->input('position');
        $user->gender = $request->input('gender');
//        $user->citizen_id = $request->input('citizen_id');
//        $user->date_of_birth = $request->input('date_of_birth');
        $user->contact_number = $request->input('contact_number');
        $user->address = $request->input('address');
        $user->workplace = $request->input('workplace');
        $user->image_name = $request->input('image_name');
        $user->email = $request->input('email');

        $user->save();

        $account = Account::where('user_id', $request->input('user_id'))->first();

        $roles = $request->input('role');
        DB::table('accounts_roles')->where('account_username', $account->username)->delete();

        foreach ($roles as $role) {
            DB::table('accounts_roles')->insert([
                    'account_username' => $account->username,
                    'role_id' => $role
                ]
            );
        }

        return response()->json([
            'message' => 'successfully updated user'
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
