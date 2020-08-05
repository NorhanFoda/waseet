<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class SavedJobResource extends JsonResource
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
            'id' => $this->saveRef->id,
            'name' => $this->saveRef->{'name_'.$lang},
            'specialization' => $this->saveRef->specialization->{'name_'.$lang},
            'work_hours' => $this->saveRef->work_hours,
            'exper_years' => $this->saveRef->exper_years.' '.trans('web.years'),
            'location' => $this->saveRef->country->{'name_'.$lang}.' - '.$this->saveRef->city->{'name_'.$lang},
            'image' => $this->saveRef->image == null ? 'no image' : $this->saveRef->image->path
        ];
    }
}
