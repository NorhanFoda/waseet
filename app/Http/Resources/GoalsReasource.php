<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalsReasource extends JsonResource
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
            'title' => $this->{'title_'.$lang},
            'text' => $this->{'text_'.$lang},
        ];
    }
}
