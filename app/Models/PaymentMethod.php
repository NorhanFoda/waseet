<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name_ar', 'name_en',
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }       
}
