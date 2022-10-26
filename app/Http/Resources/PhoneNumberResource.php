<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhoneNumberResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var PhoneNumber|PhoneNumberResource $this */
        return [
            'id' => $this->id,
            'number' => $this->number,
            'phone_type' => $this->phone_type,
            'is_default' => $this->is_default,
            'created_at' => $this->created_at,
        ];
    }
}
