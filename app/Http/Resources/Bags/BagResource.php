<?php

namespace App\Http\Resources\Bags;

use Illuminate\Http\Resources\Json\JsonResource;

class BagResource extends JsonResource
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
            'category_name' => $this->category->{'name_'.$lang},
            'image' => $this->image,
            'name' => $this->{'name_'.$lang},
            'description' => $this->{'description_'.$lang},
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings')
        ];
    }
}
