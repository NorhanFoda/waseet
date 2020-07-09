<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name_ar', 'name_en',
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }       

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
