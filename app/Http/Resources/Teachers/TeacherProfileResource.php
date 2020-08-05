<?php

namespace App\Http\Resources\Teachers;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
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
            'materials' => MaterialResource::collection($this->materials),
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'image' => $this->image == null ? 'no image' : $this->image->path,
            'role' => $this->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher'),
            'exper_years' => $this->exper_years.' '.trans('web.years'),
            'educational_level' => $this->edu_level->{'name_'.$lang},
            'nationality' => $this->nationality->{'name_'.$lang},
            'age' => $this->age.' '.trans('web.years'),
            'phone_main' => $this->phone_main,
            'phone_secondary' => $this->phone_secondary,
            'email' => $this->email,
            'address' => $this->address,
            'bio' => $this->{'bio_'.$lang},
            'is_saved' => auth()->user()->saved_teachers->contains('saveRef_id', $this->id) ? 1 : 0,
        ];
    }
}
