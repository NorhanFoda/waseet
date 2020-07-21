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
        $key  ='';
        if($this->icon == 'fa fa-facebook-f'){
            $key = 'facebook';
        }
        else if($this->icon == 'fa fa-twitter'){
            $key = 'twitter';
        }
        else if($this->icon == 'fa fa-snapchat'){
            $key = 'snapchat';
        }
        else if($this->icon == 'fa fa-instagram'){
            $key = 'instagram';
        }

        return [ 
            'key' => $key,
            'link' => $this->link,
        ];
    }
}
