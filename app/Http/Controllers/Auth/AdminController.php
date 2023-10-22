<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        \Config::set('auth.defaults.guard' , 'admin-api');
    }

     //login a User.
     public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    //Create New Token
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //Token Expired
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    //logout
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
