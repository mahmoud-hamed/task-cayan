<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Define the validation rules for the request data
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
    
        // Create a validation instance and validate the request
        $validator = validator($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
    
            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    

}
