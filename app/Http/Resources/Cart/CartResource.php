<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'bag_id' => $this->bag->id,
            'bag' => $this->bag->{'name_'.$lang},
            'rating' => $this->bag->ratings->count() > 0 ? ceil($this->bag->ratings->sum('rate') / $this->bag->ratings->count()).'/5' : trans('admin.no_ratings'),
            'price' => $this->bag->price.' '.trans('admin.sr'),
            'image' => $this->bag->images ? $this->bag->images[0]->path : null,
            'quantity' => $this->quantity,
            'branch_price' => $this->total_price,
            'buy_type' => $this->buy_type,
        ];
    }
}
