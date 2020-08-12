<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class SeekerResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_main' => $this->phone_main,
            'phone_secondary' => $this->phone_secondary,
            'age' => $this->age,
            'exper_years' => $this->exper_years,
            // 'country' => $this->country->{'name_'.$lang},
            // 'city' => $this->city->{'name_'.$lang},
            'lat' => $this->lat,
            'long' => $this->long,
            'address' => $this->address,
            'salary' => $this->salary_month,
            'cv' => $this->document->path
        ];
    }
}
