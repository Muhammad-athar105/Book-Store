<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'string',
        'title' => 'string',
        'address' => 'string|nullable',
        'phone_number' => 'integer',
        'quantity' => 'integer',
        'each_price' => 'numeric',
        'total_price' => 'numeric',
        'order_date' => 'date',
        'delivery_date' => 'date',
        'order_status' => 'string|in:delivered,pending',
        ];

        Helpers::sendError('validation error', $validator->errors() ); 
    }
}
