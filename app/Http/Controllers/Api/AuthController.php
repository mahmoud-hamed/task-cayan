<?php

namespace App\Http\Controllers\Api;

use App\helpers\helper;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public $helper;
    public function __construct()
    {
        $this->helper = new helper();

    }

    public function login(Request $request): JsonResponse
    {
        // Define the validation rules for the request data
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
    
        // Create a validation instance and validate the request
        $validator = validator($request->all(), $rules);
    
        if ($validator->fails()) {
            return  $this->helper->ResponseJson('error', 'Validation failed', $validator->errors());
        }
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
    
            return $this->helper->ResponseJson('success', 'Login successful', [
                'user' => $user,
                'access_token' => $token,
            ]);
        }
    
        return $this->helper->ResponseJson('error', 'Unauthorized');
    }
    
    /**
     * Your other methods
     */
}
