<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['message'] ='User login successfully.';
            $success['token'] =  $user->createToken('user-token')->accessToken; 
            $success['name'] =  $user->name;

            return response($success,200);
        } 
        else{ 
            return response(["message"=>'Unauthorized.'],401);
        } 
    }
}
