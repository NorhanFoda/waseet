<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobDetailsResource extends JsonResource
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
            'specialization' => $this->specialization->{'name_'.$lang},
            'work_hours' => $this->work_hours,
            'exper_years' => $this->exper_years.' '.trans('web.years'),
            'location' => $this->country->{'name_'.$lang}.' - '.$this->city->{'name_'.$lang},
            'required_number' => $this->required_number,
            'free_places' => $this->free_places,
            'description' => $this->{'description_'.$lang},
            'image' => $this->image == null ? 'no image' : $this->image->path,
            'is_saved' => auth()->user() == null ? 'unauthorized' : auth()->user()->saved_jobs->contains('saveRef_id', $this->id),
        ];
    }
}
