<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Teachers\MaterialResource;
use App\Http\Resources\Teachers\UserMaterialResource;

class editProfileResource extends JsonResource
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
            'name' => $this->name,
            'phone_main' => $this->phone_main,
            'phone_secondary' => $this->phone_secondary,
            'email' => $this->email,
            'stage_id' => $this->stage_id,
            'other_stage' => $this->other_stage,
            'nationality_id' => $this->nationality_id, 
            'other_nationality' => $this->other_nationality, 
            'lat' => $this->lat,
            'long' => $this->long,
            'address' => $this->address,
            'teaching_lat' => $this->teaching_lat,
            'teaching_long' => $this->teaching_long,
            'teaching_address' => $this->teaching_address,
            'teaching_method' => $this->teaching_method,
            'exper_years' => $this->exper_years,
            'salary_month' => $this->salary_month,
            'age' => $this->age,
            'bio_ar' => $this->bio_ar,
            'bio_en' => $this->bio_en,
            'edu_level_id' => $this->edu_level_id,
            'other_edu_level' => $this->other_edu_level,
            'edu_type_id' => $this->edu_type_id,
            'other_edu_type' => $this->other_edu_type,
            'image' => $this->image != null ? $this->image->path : asset('images/seeding/avatar.png'),
            'cv' => $this->document != null ? $this->document->path : 'no cv',
            'user_materials' => UserMaterialResource::collection($this->materials),
            'other_material' => $this->materials()->where('material_id', 4)->first() ? $this->materials()->where('material_id', 4)->first()->pivot->other_material : '',
        ];
    }
}
