<?php

namespace App\Http\Resources\Bags;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class BagDetailsResource extends JsonResource
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
        $is_saved = false;

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.Auth::guard('api')->user()->api_token){
                $is_saved = Auth::guard('api')->user() == null ? 'unauthorized': Auth::guard('api')->user()->saved_bags->contains('saveRef_id', $this->id);
            }
        }

        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->{'name_'.$lang},
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'price' => $this->price.' '.trans('admin.sr'),
            'description' => $this->{'description_'.$lang},
            'contents' => $this->{'contents_'.$lang},
            'benefits' => $this->{'benefits_'.$lang},
            'is_saved' => $is_saved,
            'link' => route('web_bags.show', $this->id),
        ];
    }
}
