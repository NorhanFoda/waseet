<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Bag;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'bag_id', 'quantity', 'total_price', 'buy_type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bag(){
        return $this->belongsTo(Bag::class);
    }

}
