<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendResponse extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            'street' => $this->street,
            'phone_number' => $this->phone_number,
            'permission' => $this->permission,
            'token' => $this->createToken("Token")->plainTextToken,
          ];
    }
}
