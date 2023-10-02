<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
                'user_id' => 'required|numeric',
                'book_id' => 'required|numeric',
                'title' => 'required|string',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0.01',
                'image' => 'required|string',
        ];
        Helpers::sendError('validation error', $validator->errors() ); 
    }
}
