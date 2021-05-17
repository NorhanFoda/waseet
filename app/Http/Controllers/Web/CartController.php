<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;
use App\Models\PaymentMethod;
use App\Models\Country;
use App\Models\City;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::with('bag')->where('user_id', auth()->user()->id)->get();
        $shipping_fees = Setting::find(1)->shipping_fees;
        $methods = PaymentMethod::with('image')->get();

        $countries = Country::all();
        $cities = count($countries) > 0 ? $countries[0]->cities : [];

        $total_price = $carts->sum('total_price');
        $total_quantity = $carts->sum('quantity');

        $sub_total = $total_price * $total_quantity;

        $total = $sub_total + $shipping_fees;

        return view('web.carts.index', compact('carts', 'shipping_fees', 'methods', 'cities', 'countries', 'total', 'sub_total'));
    }

    public function store(Request $request){

        $cart = Cart::where('user_id', auth()->user()->id)->where('bag_id', $request->bag_id)->where('quantity', $request->quantity)->where('total_price', $request->total_price)->first();
        
        if($cart == null){
            $cart = Cart::create([
                'user_id' => auth()->user()->id,
                'bag_id' => $request->bag_id,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'buy_type' => $request->buy_type,
            ]);
    
            return response()->json([
                'msg' => trans("web.added_to_cart"),
                'cart' => $cart,
            ], 200);
        }
        else{
            return response()->json([
                'msg' => trans("web.added_to_cart"),
                'cart' => $cart,
            ], 200);
        }

        // if($cart != null){
        //     $cart->delete();

        //     return response()->json([
        //         'msg' => trans("web.removed_from_cart"),
        //     ], 200);    
        // }
        // else{
        //     $cart = Cart::create([
        //         'user_id' => auth()->user()->id,
        //         'bag_id' => $request->bag_id,
        //         'quantity' => $request->quantity,
        //         'total_price' => $request->total_price,
        //         'buy_type' => $request->buy_type,
        //     ]);
    
        //     return response()->json([
        //         'msg' => trans("web.added_to_cart"),
        //         'cart' => $cart,
        //     ], 200);
        // }
    }

    public function update(Request $request){
        
        // dd($request->all());
        // Delete old carts
        foreach(auth()->user()->carts as $cart){
            $cart->delete();
        }

        // Add new carts with new values from localStorage
        $carts = $request->carts;
        // dd($carts);
        foreach($carts as $cart){
            $user_cart = Cart::create([
                'user_id' => auth()->user()->id,
                'bag_id' => $cart['bag_id'],
                'quantity' => $cart['quantity'],
                'total_price' => $cart['total_price'],
                'buy_type' => $cart['buy_type'],
            ]);

            auth()->user()->carts()->save($user_cart);
        }
    }

    public function editBuyType(Request $request){

        $cart = Cart::where('user_id', $request->user_id)->where('bag_id', $request->bag_id)->first();

        if($cart){

            $cart->update([
                'buy_type' => $request->buy_type
            ]);

            return response()->json([
                    'msg' => trans("admin.cart_updated"),
                    'cart' => $cart,
                ], 200);
        }
    }

    public function updateQuantity(Request $request){

        $cart = Cart::find($request->id);

        $cart->update([
            'quantity' => $request->quantity,
            'total_price' => $request->quantity * $cart->bag->price
        ]);

        $carts = Cart::with('bag')->where('user_id', auth()->user()->id)->get();
        $shipping_fees = Setting::find(1)->shipping_fees;
        $total_price = $carts->sum('total_price');
        $total_quantity = $carts->sum('quantity');
        $sub_total = $total_price * $total_quantity;
        $total = $sub_total + $shipping_fees;

        return response()->json([
            'sub_total' => $sub_total,
            'total' => $total,
            'single_price' => $request->quantity * $cart->bag->price,
        ], 200);
    }

    public function delete(Request $request){

        $cart = Cart::findOrFail($request->id);
        $cart->delete();

        $carts = Cart::with('bag')->where('user_id', auth()->user()->id)->get();
        $shipping_fees = Setting::find(1)->shipping_fees;
        $total_price = $carts->sum('total_price');
        $total_quantity = $carts->sum('quantity');
        $sub_total = $total_price * $total_quantity;
        $total = $sub_total + $shipping_fees;

        return response()->json([
            'sub_total' => $sub_total,
            'total' => $total,
            'single_price' => $request->quantity * $cart->bag->price,
        ], 200);
    }
}
