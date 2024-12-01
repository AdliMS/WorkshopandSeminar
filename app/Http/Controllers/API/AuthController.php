<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    public function login(Request $request) {

        try {
            $validate = Validator::make($request-> all(),
                [
                    'name' => 'required',
                    'password' => 'required',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors(),
                ], 401);
            }

            if (!Auth::attempt($request->only(['name', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & password does not match with our records.',
                ], 401);
            }

            $user = User::where('name', $request->name)->first();

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully.',
                'token' => $user->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',
            ], 200);

        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage(),
            ], 500);
        };
    
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

}
