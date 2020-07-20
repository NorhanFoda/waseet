<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::with('bag')->where('user_id', auth()->user()->id)->get();
        $shipping_fees = Setting::find(1)->shipping_fees;
        return view('web.carts.index', compact('carts', 'shipping_fees'));
    }

    public function store(Request $request){
        $cart = Cart::where('user_id', auth()->user()->id)->where('bag_id', $request->bag_id)->where('quantity', $request->quantity)->where('total_price', $request->total_price)->first();
        if($cart != null){
            $cart->delete();

            return response()->json([
                'msg' => trans("web.removed_from_cart"),
            ], 200);    
        }
        else{
            $cart = Cart::create([
                'user_id' => auth()->user()->id,
                'bag_id' => $request->bag_id,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'buy_type' => $request->buy_type,
            ]);
    
            return response()->json([
                'msg' => trans("web.added_to_cart"),
            ], 200);
        }
    }

    public function update(Request $request){
        
        $cart = Cart::findOrFail($request->cart_id);
        $cart->update([
                'total_price' => $request->total_price,
                'quantity' => $request->quantity
            ]);
    }

    public function delete(Request $request){
        $cart = Cart::findOrFail($request->cart_id);
        $cart->delete();
    }
}
