<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:4',
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'phone' => $validate['phone'],
            'password' => Hash::make($validate['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    public function getAllUsers(){
        $users = User::all();
        if($users->isEmpty()){
            return response()->json([
                'success'=>false,
                'message'=> 'No users found'
            ],404);
        }
        return response()->json([
            'success'=>true,
            'message'=> 'Users retrieved successfully',
            'users'=>$users
        ],200);
    }

    public function getUserById($id){
        $user = User::find($id)->first();
        if(!$user){
            return response()->json([
                'success'=>false,
                'message'=> 'User not found'
            ],404);
        }
         return response()->json([
            'success'=>true,
            'message'=>'User successfuly retrived',
            'user' => $user
        ],200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}
