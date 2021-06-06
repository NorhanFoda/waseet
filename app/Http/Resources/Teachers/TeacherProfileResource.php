<?php

namespace App\Http\Resources\Teachers;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

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
        $is_saved = false;
        $nationality = '';
        if($this->nationality_id != null){
            $nationality = $this->nationality_id == 3 ? $this->other_nationality : $this->nationality->{'name_'.$lang};
        }

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.Auth::guard('api')->user()->api_token){
                $is_saved = Auth::guard('api')->user() == null ? 'unauthorized': Auth::guard('api')->user()->saved_teachers->contains('saveRef_id', $this->id);
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'materials' => MaterialResource::collection($this->materials),
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'image' => $this->image == null ? asset('images/seeding/avatar.png') : $this->image->path,
            'role' => $this->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher'),
            'exper_years' => $this->exper_years.' '.trans('web.years'),
            'educational_level' => $this->edu_level_id == 4 ? $this->other_edu_level : $this->edu_level->{'name_'.$lang},
            'nationality' => $nationality,
            'age' => $this->age.' '.trans('web.years'),
            'phone_main' => $this->phone_main,
            'phone_secondary' => $this->phone_secondary,
            'email' => $this->email,
            'address' => $this->address,
            'lat' => $this->lat,
            'long' => $this->long,
            'teaching_lat' => $this->teaching_lat != null ? $this->teaching_lat : null,
            'teaching_long' => $this->teaching_long != null ? $this->teaching_long : null,
            'teaching_address' => $this->teaching_address != null ? $this->teaching_address : null,
            'bio' => $this->{'bio_'.$lang},
            'teaching_method' => $this->hasRole('online_teacher') ? $this->teaching_method : '',
            'is_saved' => $is_saved,
        ];
    }
}
