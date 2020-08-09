<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = \App::getLocale();
        return [
            'id' => $this->id,
            'lang' => $this->lang,
            'long' => $this->long,
            // 'country' => $this->country->{'name_'.$lang},
            // 'city' => $this->city->{'name_'.$lang},
            'address' => $this->address,
            // 'postal_code' => $this->postal_code
        ];
    }
}
