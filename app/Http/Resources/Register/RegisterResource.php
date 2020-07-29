<?php

namespace App\Http\Resources\Register;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
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
            'name' => $this->{'name_'.$lang}
        ];
    }
}
