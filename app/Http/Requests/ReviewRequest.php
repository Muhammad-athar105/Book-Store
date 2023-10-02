<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
        'book_id' => 'required|integer',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        ];
        Helpers::sendError('validation error', $validator->errors() ); 
    }

    
}
