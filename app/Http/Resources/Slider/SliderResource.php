<?php

namespace App\Http\Resources\Slider;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'image' => $this->image->path,
            'title' => $this->{'title_'.$lang},
            'body' => $this->{'title_'.$lang}
        ];
    }
}
