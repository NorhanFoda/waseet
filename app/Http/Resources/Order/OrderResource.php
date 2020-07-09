<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'shippment_number' => $this->id,
            'date' => $this->created_at->toDateString(),
            'quantity' => $this->bags->count(),
            'total_price' => $this->total_price + $this->shipping_fees.' '.trans('admin.sr')

        ];
    }
}
