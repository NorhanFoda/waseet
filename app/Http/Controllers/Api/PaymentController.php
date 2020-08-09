<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Setting;
use App\Models\BagOrder;
use App\Models\Bag;
use App\Models\Cart;
use App\Models\Bank;
use App\Models\Image;
use App\Models\BankReceipt;
use App\Http\Resources\Bank\BankResource;
use App\Http\Resources\Order\ReportResource;
use App\Http\Requests\Order\OrderRequest;
use App\Classes\Upload;
use App\Classes\SendEmail;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function getBanks(){
        return response()->json([
            'banks' => BankResource::collection(Bank::with('image')->get()),
        ], 200);
    }

    public function prepareOrder(OrderRequest $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
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
                            'error' => trans('api.error'),
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

                //Get updated carts and prepare order
                $carts = auth()->user()->carts;
                
                if(count($carts) == 0){
                    return response()->json([
                        'error' => trans('web.cart_empty')
                    ], 404);
                }

                $shipping_fees = Setting::find(1)->shipping_fees;

                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'total_price' => $carts->sum('total_price'),
                    'address_id' => $request->address_id,
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

                return response()->json([
                    'success' => trans('api.order_created'),
                ], 200);
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function storeBankPayment(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $this->validate($request, [
                    'bank_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'cost' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'order_id' => 'required'
                ]);
        
                $receipt = BankReceipt::create($request->all());
                $receipt->update(['user_id' => auth()->user()->id]);
        
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $receipt->id,
                    'imageRef_type' => 'App\Models\BankReceipt'
                ]);
                $receipt->image()->save($image);
        
                $order = Order::with('address')->find($request->order_id);
                $order->update(['status' => 2]);
                $order->bags()->update([
                    'accepted' => Carbon::now()
                ]);
        
                // If order contains buy online bags, then send email bag contents
                if($order->bags()->where('buy_type', 1)->exists()){
        
                    $bags = $order->bags()->where('buy_type', 1)->get();
                    
                    SendEmail::sendBagContents($bags, auth()->user()->email);
        
                    return response()->json([
                        'success' => trans('web.bag_contents_emailed')
                    ], 200);
                }
                else{
                    return response()->json([
                        'success' => trans('api.payment_saved')
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function getOrderReporrt($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $order = Order::with('address')->find($id);

                if($order == null){
                    return response()->json([
                        'error' => trans('web.error')
                    ], 200);
                }

                return response()->json([
                    'data' => new ReportResource(Order::with('address')->find($id))
                ], 200);
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }
}
