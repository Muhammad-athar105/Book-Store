<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Validate the login credentials
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ];

        Helpers::sendError('validation error', $validator->errors() ); 
       
    }
}
