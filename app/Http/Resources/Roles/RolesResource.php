<?php

namespace App\Http\Resources\Roles;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
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

        $role;

        if($this->name == 'student'){
            $role = trans('web.student');
        }
        else if($this->name == 'direct_teacher'){
            $role = trans('web.direct_teacher');
        }
        else if($this->name == 'online_teacher'){
            $role = trans('web.online_teacher');
        }
        else if($this->name == 'organization'){
            $role = trans('web.organization');
        }
        else if($this->name == 'job_seeker'){
            $role = trans('web.job_seeker');
        }
        
        return [
            'id' => $this->id,
            'role' => $role,
        ];
    }
}
