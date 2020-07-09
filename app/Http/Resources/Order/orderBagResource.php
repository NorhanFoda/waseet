<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class orderBagResource extends JsonResource
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
            'name' => $this->{'name_'.$lang},
            'image' => $this->image,
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'quantity' => $this->pivot->quantity,
            'total_price' => $this->pivot->total_price
        ];
    }
}
