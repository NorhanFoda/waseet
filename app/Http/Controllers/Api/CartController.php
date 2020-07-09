<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;
use App\Http\Resources\Cart\CartResource;
use Auth;

class CartController extends Controller
{

    public function index(){

        $shipping_fees = Setting::find(1)->shipping_fees;
        $total_branch_price = 0;

        $carts = auth()->user()->carts;

        foreach($carts as $cart){
            $total_branch_price += $cart->total_price;
        }

        $total = $total_branch_price  +  $shipping_fees;

        return response()->json([
            'carts' => CartResource::collection($carts),
            'shipping_fees' => $shipping_fees,
            'total_branch_price' => $total_branch_price,
            'total' => $total
        ], 200);
    }

    public function store(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, [
                'bag_id' => 'required',
                'quantity' => 'required',
                'total_price' => 'required',
                'buy_type' => 'required'
            ]);

            $cart = Cart::create([
                'user_id' => auth()->user()->id,
                'bag_id' => $request->bag_id,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'buy_type' => $request->buy_type == 'onlinebuy' ? 1 : 2
            ]);
            
            auth()->user()->carts()->save($cart);

            if($cart == null){
                return response()->json([
                    'error' => trans('api.error'),
                ], 400);
            }

            return response()->json([
                'success' => trans('api.success'),
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function update(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, [
                'id' => 'required',
                'bag_id' => 'required',
                'quantity' => 'required',
                'total_price' => 'required',
                'buy_type' => 'required'
            ]);
    
            $cart = auth()->user()->carts()->find($request->id);
    
            $cart->update([
                'bag_id' => $request->bag_id,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'buy_type' => $request->buy_type == 'onlinebuy' ? 1 : 2
            ]);
    
            if(!$cart){
                return response()->json([
                    'error' => trans('api.error'),
                ], 400);
            }
    
            return response()->json([
                'success' => trans('api.success'),
            ], 400);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function destroy(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, ['id' => 'required']);

            $cart = auth()->user()->carts()->find($request->id);
            $cart->delete();

            if(!$cart){
                return response()->json([
                    'error' => trans('api.error'),
                ], 400);
            }

            return response()->json([
                'success' => trans('api.success'),
            ], 400);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }
}
