<?php

namespace App\Traits;

use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait Register {

    use SendJsonResponse;
    public function create(Request $request){
        $validator  =   $this->validateRequest($request);
        if($validator->fails()){
            return $this->sendJsonError($validator->errors(),VALIDATION_ERROR);
        }
        User::create(); 
    }
    public function validateRequest(Request $request){
        $validator  =   Validator::make($request->all(),[
        "email"             =>  ["required","email","unique:users:email"],
        "password"          =>  ["required","confirmed",new StrongPassword],
        "contact_number"    =>  ["required","digits:10", "regex:/^[0-9]+$/"],
        "name"              =>  ["required", "string", "regex:/^[A-Za-z]+$/"],]);

        return $validator;
    }
}