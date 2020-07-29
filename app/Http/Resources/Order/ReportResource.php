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
            'address' => $this->address->country->{'name_'.$lang}.' - '.$this->address->city->{'name_'.$lang}.' - '.$this->address->address
        ];
    }
}
