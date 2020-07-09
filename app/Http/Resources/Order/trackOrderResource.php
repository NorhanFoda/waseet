<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\orderBagResource;

class trackOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status;
        if($this->status == 1){
            $status = trans('api.not_confirmed');
        }
        else if($this->status == 2){
            $status = trans('api.waiting');
        }
        else if($this->status == 3){
            $status = trans('api.shipping');
        }
        else if($this->status == 4){
            $status = trans('api.delivered');
        }

        return [
            'bags' => orderBagResource::collection($this->bags),
            'status' => $status,
        ];
    }
}
