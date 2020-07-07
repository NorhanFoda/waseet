<?php

namespace App\Http\Resources\Socials;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialResurce extends JsonResource
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
            'link' => $this->link,
            'icon' => $this->image->path,
        ];
    }
}
