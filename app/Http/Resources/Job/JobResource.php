<?php

namespace App\Http\Resources\Job;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class JobResource extends JsonResource
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
        $is_saved = false;

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.Auth::guard('api')->user()->api_token){
                $is_saved = Auth::guard('api')->user() == null ? 'unauthorized': Auth::guard('api')->user()->saved_jobs->contains('saveRef_id', $this->id);
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->{'name_'.$lang},
            'specialization' => $this->specialization_id == 3 && $this->other_specialization != null ? $this->other_specialization: $this->specialization->{'name_'.$lang},
            'work_hours' => $this->work_hours,
            'exper_years' => $this->exper_years.' '.trans('web.years'),
            // 'location' => $this->country->{'name_'.$lang}.' - '.$this->city->{'name_'.$lang},
            'country' => $this->country,
            'location' => $this->address,
            'image' => $this->image == null ? 'no image' : $this->image->path,
            'is_saved' => $is_saved,
        ];
    }
}
