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
            $status = trans('web.order_waiting');
            if($this->bags[0]->pivot->accepted != null){
                $status = $status.' '.date('Y-m-d', strtotime($this->bags[0]->pivot->accepted ?? ''->Fecha));
            } 
        }
        else if($this->status == 3){
            $status = trans('web.order_is_shipped');
            if($this->bags[0]->pivot->shipped != null){
                $status = $status.' '.date('Y-m-d', strtotime($this->bags[0]->pivot->shipped ?? ''->Fecha));
            }
        }
        else if($this->status == 4){
            $status = trans('web.order_is_delivered');
            if($this->bags[0]->pivot->delivered != null){
                $status = $status.' '.date('Y-m-d', strtotime($this->bags[0]->pivot->delivered ?? ''->Fecha));
            }
        }

        return [
            'bags' => orderBagResource::collection($this->bags),
            'staus' => $this->status,
            'status_text' => $status,
        ];
    }
}
