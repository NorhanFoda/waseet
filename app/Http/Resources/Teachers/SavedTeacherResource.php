<?php

namespace App\Http\Resources\Teachers;

use Illuminate\Http\Resources\Json\JsonResource;

class SavedTeacherResource extends JsonResource
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

        if(!$this->saveRef->hasRole('admin')){
            return [
                'id' => $this->saveRef->id,
                'name' => $this->saveRef->name,
                'materials' => MaterialResource::collection($this->saveRef->materials),
                'rating' => $this->saveRef->ratings->count() > 0 ? ceil($this->saveRef->ratings->sum('rate') / $this->saveRef->ratings->count()).'/5' : trans('admin.no_ratings'),
                'image' => $this->saveRef->image == null ? 'no image' : $this->saveRef->image->path,
                'role' => $this->saveRef->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher'),
                'nationality' => $this->nationality_id != null ? $this->saveRef->nationality->{'name_'.$lang} : '',
                'address' => $this->saveRef->address,
                'is_saved' => auth()->user() == null ? 'unauthorized': auth()->user()->saved_teachers->contains('saveRef_id', $this->saveRef->id),
            ];
        }
        // else{
        //     return [];
        // }
    }
}
