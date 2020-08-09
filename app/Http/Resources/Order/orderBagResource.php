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

        if($this->pivot->buy_type == 1){
            $link = route('api_order.bag_contents', $this->id);
        }
        else{
            $link = '#';
        }
        
        return [
            'id' => $this->id,
            'name' => $this->{'name_'.$lang},
            'image' => $this->image,
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'quantity' => $this->pivot->quantity,
            'total_price' => $this->pivot->total_price,
            'purchase_type' => $this->pivot->buy_type,
            'bag_contents' => $link
        ];
    }
}
