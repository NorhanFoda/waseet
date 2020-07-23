<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bag;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\User;
use App\Models\BankReceipt;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_price', 'address_id',
        'status', 'shipping_fees', 'payment_method_id'
    ];

    public function bags(){
        return $this->belongsToMany(Bag::class)
                        ->withPivot('total_price', 'quantity', 'accepted', 'shipped', 'delivered',
                        'id', 'created_at', 'updated_at', 'bag_id', 'order_id', 'buy_type');
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function receipt(){
        return $this->hasOne(BankReceipt::class);
    }
}
