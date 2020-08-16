<?php

namespace App\Http\Resources\Bags;

use Illuminate\Http\Resources\Json\JsonResource;

class SavedBagResource extends JsonResource
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
            'id' => $this->saveRef->id,
            'category_name' => $this->saveRef->category->{'name_'.$lang},
            'image' => $this->saveRef->image,
            'name' => $this->saveRef->{'name_'.$lang},
            'description' => $this->saveRef->{'description_'.$lang},
            'rating' => $this->saveRef->ratings->count() > 0 ? ceil($this->saveRef->ratings->sum('rate') / $this->saveRef->ratings->count()).'/5' : trans('admin.no_ratings'),
            'is_saved' => auth()->user() == null ? 'unauthorized': auth()->user()->saved_bags->contains('saveRef_id', $this->saveRef->id),
        ];
    }
}
