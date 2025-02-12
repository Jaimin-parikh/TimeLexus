<?php

namespace App\Http\Requests\Auth;

use App\Rules\StrongPassword;
use App\Traits\SendJsonResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
{
    use SendJsonResponse; 
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email"             =>  ["required","email","unique:users:email"],
            "password"          =>  ["required","confirmed",new StrongPassword],
            "contact_number"    =>  ["required","digits:10", "regex:/^[0-9]+$/"],
            "name"              =>  ["required", "string", "regex:/^[A-Za-z]+$/"],
        ];
    }

   
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code'      => VALIDATION_ERROR,
            'message'   => __("messages.VALIDATION_ERROR"),
            'data'      => $validator->errors()
        ]));
    }
}
