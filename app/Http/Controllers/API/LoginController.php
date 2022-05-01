<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
     public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 

            $success['token'] =  $user->createToken('user-token')->accessToken; 
            $success['name'] =  $user->name;

            return $this->sendResponse($success,"User login successfully.",200);
        } 
        else{ 
            return $this->sendError('Unauthorized.',['error'=>'Unauthorized']);
        } 
    }
}
