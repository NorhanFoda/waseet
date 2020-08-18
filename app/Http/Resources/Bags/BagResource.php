<?php

namespace App\Http\Resources\Bags;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class BagResource extends JsonResource
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
            'category_name' => $this->category->{'name_'.$lang},
            'image' => $this->image,
            'name' => $this->{'name_'.$lang},
            'description' => $this->{'description_'.$lang},
            'rating' => $this->ratings->count() > 0 ? ceil($this->ratings->sum('rate') / $this->ratings->count()).'/5' : trans('admin.no_ratings'),
            'is_saved' => $is_saved,
        ];
    }
}
