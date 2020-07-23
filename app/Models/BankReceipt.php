<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Bank;

class BankReceipt extends Model
{
    protected $fillable = [
        'user_id',
        'bank_id',
        'order_id',
        'name',
        'email',
        'phone',
        'cost',
        'details',
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function bank(){
        return $this->belongsTo(bank::class);
    }

}
