<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\trackOrderResource;

class OrderController extends Controller
{
    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            return response()->json([
                'orders' => OrderResource::collection(auth()->user()->orders)
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.error')
            ], 400);
        }
    }

    public function trackOrder(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, ['order_id' => 'required']);

            $order = Order::find($request->order_id);

            if($order == null){
                return response()->json([
                    'error' => trans('api.error')
                ], 40);
            }

            return response()->json([
                'order' => new trackOrderResource($order)
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.error')
            ], 400);
        }
    }
}
