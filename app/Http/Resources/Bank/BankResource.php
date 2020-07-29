<?php

namespace App\Http\Resources\Bank;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Image\ImageResource;

class BankResource extends JsonResource
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
            'account_number' => $this->account_number,
            'iban' => $this->iban,
            'image' => new ImageResource($this->image)
        ];
    }
}
