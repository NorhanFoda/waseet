<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Order;
use App\Models\BagOrder;
use App\Models\Bag;

class PaymentController extends Controller
{
    public function prepareOrder($address_id){
        $total_price = 0;
        $shipping_fees = Setting::find(1)->shipping_fees;
        $carts = auth()->user()->carts;
        
        foreach($carts as $cart){
            $total_price += $cart->total_price;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => $total_price,
            'address_id' => $address_id,
            'status' => 1, // Not confirmed
            'shipping_fees' => $shipping_fees,
        ]);

        foreach($carts as $cart){
            $bag = Bag::findOrFail($cart->bag_id);
            $order->bags()->attach($bag);
            $order->bags()->update([
                'total_price' => $cart->total_price,
                'quantity' => $cart->quantity,
                'buy_type' => $cart->buy_type
            ]);   
            
            $cart->delete();
        }

        //redirect to confirmation page
    }
}
