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
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                return response()->json([
                    'orders' => OrderResource::collection(auth()->user()->orders)
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
                'error' => trans('api.error')
            ], 400);
        }
    }

    public function trackOrder($order_id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){

                $order = Order::find($order_id);

                if($order == null){
                    return response()->json([
                        'error' => trans('api.error')
                    ], 404);
                }

                return response()->json([
                    'order' => new trackOrderResource($order)
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
                'error' => trans('api.error')
            ], 400);
        }
    }

    public function getBagContents($bag_id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                return response()->json([
                    'data' => Bag::with(['images', 'videos', 'documents'])->find($id)
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
                'error' => trans('api.error')
            ], 400);
        }
    }
}
