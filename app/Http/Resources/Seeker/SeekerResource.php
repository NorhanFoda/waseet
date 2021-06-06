<?php

namespace App\Http\Resources\Seeker;

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

        if(!$this->hasRole('admin')){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => $this->image != null ? $this->image->path : asset('images/seeding/avatar.png'),
                'cv' => $this->document != null ? $this->document->path : 'no cv',
                'email' => $this->email,
                'phone_main' => $this->phone_main,
                'phone_secondary' => $this->phone_secondary != null ? $this->phone_secondary : 'no seconday phone',
                'ecpected_salary' => $this->salary_month.''.trans('admin.sr'),
                'exper_years' => $this->exper_years
            ];
        }
    }
}
