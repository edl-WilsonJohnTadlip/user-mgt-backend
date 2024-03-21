<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        //input validation
        //name, email, password, address, phonenumber, birthdate, gender
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
            'address' => ['required','string','max:255'],
            'phonenumber' => ['required','integer'],
            'gender' => ['required','string','max:10'],
            'age' => ['required','integer'],
            'role' => ['required','string'],
        ]);

        $role = Role::where('name', $request['role'])->firstOrFail();

        if($role!=null){
            $user = User::create([
                'fname' => $validatedData['fname'],
                'lname' => $validatedData['lname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'address' => $validatedData['address'],
                'phonenumber' => $validatedData['phonenumber'],
                'gender' => $validatedData['gender'],
                'age' => $validatedData['age'],

        ]);

        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
            // Return the created user
            return $user;
        
        }else{
            response()->json([
                'message' => 'Invalid role name'
        ], 200);
        }
    }

    public function login(Request $request) 
    {
        //input validation
        $validatedData = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        if(!Auth::attempt([

            'email' => $validatedData['email'],
            'password' => $validatedData['password'],

        ])){
            return response()->json([
                'message' => 'Invalid email and or password'
            ], 401);
            }
        
        //get user object
        $user = User::where('email', $request['email'])->with('roles')->firstOrFail();

        // get role name
        $roleName = $user->roles->pluck('name')->toArray();

        //if successful, generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user_id' => $user->id,
            'role' => $roleName,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        request()->user()->tokens()->delete();

        return response()->json([
            'message' => 'token successfully revoked'
        ]);
    }
  
}
