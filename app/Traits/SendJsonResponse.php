<?php

namespace App\Traits;

Trait SendJsonResponse{
    public function sendJsonError($data,$code){
        if($code == VALIDATION_ERROR){
            $msg    =   __("messages.VALIDATION_ERROR");
        }else{
            $msg    =   __("messages.SERVER_ERROR");
        }
        return response()->json(["code"=>$code ,"message"=>$msg,"data"=>$data]);
    }
    public function sendSuccess($code,$data,$msg){
        return response()->json(["code"=>$code ,"message"=>$msg,"data"=>$data]);
    }
}