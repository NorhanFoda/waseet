<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'cost' => $this->total_price + $this->shipping_fees.' '.trans('admin.sr'),
            'address' => $this->buy_type == 2 && $this->address ? $this->address->address : null,
            'payment_method' => $this->payment_method ? $this->payment_method->{'name_'.$lang} : null,
            'buy_type' => $this->buy_type == 1 ? trans('web.buy_online') : trans('web.print_content'),
        ];
    }
}
