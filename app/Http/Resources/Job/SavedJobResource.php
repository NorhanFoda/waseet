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
            // 'location' => $this->saveRef->country->{'name_'.$lang}.' - '.$this->saveRef->city->{'name_'.$lang},
            'location' => $this->saveRef->address,
            'image' => $this->saveRef->image == null ? asset('images/seeding/avatar.png') : $this->saveRef->image->path,
            'is_saved' => auth()->user() == null ? 'unauthorized': auth()->user()->saved_jobs->contains('saveRef_id', $this->saveRef->id),
        ];
    }
}
