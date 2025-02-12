<?php

namespace App\Traits;

use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

Trait UserLogin{
    
    use SendJsonResponse;
    public function login(Request $loginRequest){
        $validator      =$this->validateLoginRequest($loginRequest);
        if($validator->fails()){
            return $this->SendJsonError($validator->errors(),VALIDATION_ERROR);
        }
        $username       =   $loginRequest->input("email") ?? $loginRequest->input("contact_number");
        $input_password =   md5($loginRequest->input("password"));
        $user           =   User::where("email",$username)->orWhere("contact_number",$username)->first();
        $password       =   $user->password;
        switch($password){
            case $password == $input_password:
                $token = $user->createToken('authToken')->plainTextToken;
                $data   =   [
                                "token"=>$token
                            ];
                $msg    =   __("messages.SUCCESSFUL_LOGIN");   
                return $this->sendSuccess(200,$data ,$msg);
            default:
                return $this->sendSuccess(200,"",__("messages.CREDENTIAL_MISMATCH"));
        }
    }
    public function validateLoginRequest(Request $loginRequest){
        $validator      =   Validator::make($loginRequest->all(),  [
                                    "email"             =>  ["required_if:contact_number,null","email","exists:users,email"],
                                    "password"          =>  ["required",new StrongPassword],
                                    "contact_number"    =>  ["required_if:email,null","digits:10", "regex:/^[0-9]+$/","exists:users,contact_number"],
                                ]);
        return $validator;
    }
}
