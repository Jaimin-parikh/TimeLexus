<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use UserLogin;

    public function logout(Request $request){
        if(Auth::check()){
            $request->user()->currentAccessToken()->delete();
            // $request->user()->logout();
            return $this->sendSuccess(SUCCESS,"",__("auth.LOGGED_OUT"));
        }
    }
}
