<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

if (!function_exists('checkPasswordStrength')) {
    function checkPasswordStrength($password)
    {
        $validator = Validator::make(
            ['password' => $password],
            ['password' => [Password::min(8)->letters()->mixedCase()->symbols()]]
        );
        return !$validator->fails() ;
    }
}
