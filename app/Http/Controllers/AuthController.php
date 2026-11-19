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
}
