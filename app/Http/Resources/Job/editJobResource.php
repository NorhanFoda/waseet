<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class editJobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'specialization' => $this->specialization_id,
            'other_specialization' => $this->other_specialization,
            'exper_years' => $this->exper_years,
            'work_hours' => $this->work_hours,
            'required_number' => $this->required_number,
            'free_places' => $this->free_places,
            'age' => $this->age,
            'salary' => $this->salary,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            // 'location' => $this->country->{'name_'.$lang}.' - '.$this->city->{'name_'.$lang},
            'lat' => $this->lat,
            'long' => $this->long,
            'location' => $this->address,
            'country' => $this->country,
            'image' => $this->image == null ? 'no image' : $this->image->path,
            'announcer_id' => $this->announcer->id,
        ];
    }
}
