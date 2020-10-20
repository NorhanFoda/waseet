<?php

namespace App\Http\Resources\Teachers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Teachers\MaterialResource;
use Auth;

class TeacherResource extends JsonResource
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
                $is_saved = Auth::guard('api')->user() == null ? 'unauthorized': Auth::guard('api')->user()->saved_teachers->contains('saveRef_id', $this->id);
            }
        }

        if(!$this->hasRole('admin')){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'materials' => MaterialResource::collection($this->materials),
                'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
                'image' => $this->image == null ? 'no image' : $this->image->path,
                'role' => $this->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher'),
                'nationality' => $this->nationality_id != null ? $this->nationality->{'name_'.$lang} : '',
                'address' => $this->address,
                'is_saved' => $is_saved,
            ];
        }
        // else{
        //     return [];
        // }
    }
}
