<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplyJobFormResource extends JsonResource
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
            'name' => $this->{'name_'.$lang},
            'lat' => $this->lat,
            'long' => $this->long,
            'address' => $this->address
        ];
    }
}
