<?php

namespace App\Http\Resources\Bags;

use Illuminate\Http\Resources\Json\JsonResource;

class BagCategoryResource extends JsonResource
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
            // 'image' => $this->image ? $this->image->path : 'no image',
            'image' => $this->image ? $this->image->path : null,
            'name' => $this->{'name_'.$lang}
        ];
    }
}
