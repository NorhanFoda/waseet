<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;
use App\Models\Bag;
use App\Http\Resources\Cart\CartResource;
use App\Http\Requests\Carts\CartRequest;
use Auth;

class CartController extends Controller
{

    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                
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
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);    
            }
        }
        return response()->json([
            'error' => trans('api.unauthorized')
        ], 400);
    }

    public function store(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $this->validate($request, [
                    'bag_id' => 'required',
                    'quantity' => 'required',
                    'total_price' => 'required',
                    'buy_type' => 'required'
                ]);
    
                $bag = Bag::find($request->bag_id);

                if($bag == null){
                    return response()->json([
                        'error' => trans('api.bag_not_foung'),
                    ], 400);
                }
    
                $cart = Cart::create([
                    'user_id' => auth()->user()->id,
                    'bag_id' => $request->bag_id,
                    'quantity' => $request->quantity,
                    'total_price' => $request->total_price,
                    'buy_type' => $request->buy_type,
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
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function updateCarts(CartRequest $request){
        
        $old_carts = auth()->user()->carts;
        
        // Delete old carts
        foreach($old_carts as $cart){
            $cart->delete();
        }

        // Add new carts with new values from localStorage
        foreach($request->carts as $cart){
            
            $bag = Bag::find($cart['bag_id']);

            if($bag == null){
                return response()->json([
                    'error' => trans('api.bag_not_foung'),
                ], 400);
            }

            $user_cart = Cart::create([
                'user_id' => auth()->user()->id,
                'bag_id' => $cart['bag_id'],
                'quantity' => $cart['quantity'],
                'total_price' => $cart['total_price'],
                'buy_type' => $cart['buy_type'],
            ]);

            if(!$user_cart){
                return response()->json([
                    'error' => trans('api.error'),
                ], 400);
            }

            auth()->user()->carts()->save($user_cart);
        }

        return response()->json([
            'success' => trans('admin.updated')
        ], 200);
    }

    // public function update(Request $request){
    //     if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
    //         $this->validate($request, [
    //             'carts' => 'required|array',
    //             'carts.*.id' => 'required',
    //             "carts.*.bag_id" => 'required',
    //             "carts.*.quantity" => 'required',
    //             "carts.*.total_price" => 'required',
    //             "carts.*.buy_type" => 'required',
    //         ]);
    
    //         $carts = auth()->user()->carts;
            
    //         // Delete old carts
    //         foreach($carts as $cart){
    //             $cart->delete();
    //         }

    //         foreach($request->carts as $cart){
    //             $bag = Bag::find($cart['bag_id']);
    //             if($bag == null){
    //                 return response()->json([
    //                     'error' => trans('api.error'),
    //                 ], 400);
    //             }

    //             $user_cart = Cart::create([
    //                 'user_id' => auth()->user()->id,
    //                 'bag_id' => $cart['bag_id'],
    //                 'quantity' => $cart['quantity'],
    //                 'total_price' => $cart['total_price'],
    //                 'buy_type' => $cart['buy_type'],
    //             ]);

    //             auth()->user()->carts()->save($user_cart);

    //             if(!$user_cart){
    //                 return response()->json([
    //                     'error' => trans('api.error'),
    //                 ], 400);
    //             }
    //         }
    
    //         return response()->json([
    //             'success' => trans('api.success'),
    //         ], 400);
    //     }
    //     else{
    //         return response()->json([
    //             'error' => trans('api.unauthorized')
    //         ], 400);
    //     }
    // }

    // public function destroy(Request $request){
    //     if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
    //         $this->validate($request, ['id' => 'required']);

    //         $cart = auth()->user()->carts()->find($request->id);
    //         $cart->delete();

    //         if(!$cart){
    //             return response()->json([
    //                 'error' => trans('api.error'),
    //             ], 400);
    //         }

    //         return response()->json([
    //             'success' => trans('api.success'),
    //         ], 400);
    //     }
    //     else{
    //         return response()->json([
    //             'error' => trans('api.unauthorized')
    //         ], 400);
    //     }
    // }
}
