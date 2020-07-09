<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagOrder extends Model
{
    protected $table = 'bag_order';
    protected $fillable = [
        'bag_id', 'order_id',
        'total_price', 'quantity',
        'accepted', 'shipped', 'delivered'
    ];
    
    protected $dates = ['accepted', 'shipped', 'delivered', 'created_at', 'updated_at'];
}
