<?php

namespace App\Traits;

use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Trait UserLogin{
    
    use SendJsonResponse;
    public function login(Request $loginRequest){
        $this->validateLoginRequest($loginRequest);

        $user_name  =   $loginRequest->input("email") ?? $loginRequest->input("contact_number");
        $password   =   $loginRequest->input("password");
        $user       = User::where("email", $user_name)->orWhere("contact_number", $user_name)->first();
        if(Auth::attempt(['email' => $user_name, 'password' => $password]) || Auth::attempt(['contact_number' => $user_name, 'password' => $password])){
            $ability= $user->is_admin ? "*":'authToken';
            $expire_at= $user->is_admin ? now()->addHour():now()->addDays(15);
            $token = $user->createToken($user->id,[$ability],$expire_at)->plainTextToken;
            $data   =   [
                "token"     =>$token,
                "user_data" =>Auth::user()
            ];
            $msg    =   __("messages.SUCCESSFUL_LOGIN");   
            return $this->sendSuccess(200,$data ,$msg);
        }else
            return $this->sendSuccess(200,"",__("messages.CREDENTIAL_MISMATCH"));
    }
    public function validateLoginRequest(Request $loginRequest){
        $loginRequest->validate([ 
            "email"             =>  ["required_without:contact_number","email","exists:users,email"],
            "password"          =>  ["required",new StrongPassword],
            "contact_number"    =>  ["required_without:email","digits:10", "regex:/^[0-9]+$/","exists:users,contact_number"],
        ]);
    }
}
