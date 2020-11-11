<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotificationsResource extends JsonResource
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

        // $this->update(['read' => 1]);
        
        return [
            'id' => $this->id,
            'message' => $this->{'msg_'.$lang},
            // 'image' => $this->image,
            'seen' => $this->read == 0 ? false : true,
            'type' => $this->type,
            'extra_data' => $this->extra_data,
            'sent_since' => $this->created_at->diffForHumans(Carbon::now())
        ];
    }
}
