<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    

    public function authorize(): bool
    {
        return true;
    }

   
     // Validate the Register request parameters
     public function rules(): array
     {
         return [
             'name' => 'required|string',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:6',
             'address' => 'string',
             'country' => 'string',
             'city' => 'string',
             'street' => 'steet',
             'phone_number' => 'integer',
         ];
 
         Helpers::sendError('validation error', $validator->errors() ); 
     }
}
