<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response; 
use Illuminate\Http\Exceptions\Http; 


class Helper {
  // Errors 
  public static function sendError($message, $errors = [], $code = 401)
  {
     $response = ['success'=> false, 'message'=>$message];
     if(!empty($errors)){
      $response['data'] = $errors;
     }

     throw new HttpResponseExceptions($response()->json($response, $code));
     
}
}
