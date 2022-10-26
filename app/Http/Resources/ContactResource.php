<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Contact|ContactResource $this */
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            'title' => $this->title,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'created_at' => $this->created_at,
            
            'phone_numbers' => PhoneNumberResource::collection($this->phoneNumbers),
            'default_phone_number' => $this->default_phone_number,
        ];
    }
}
