<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Http\Resources\Payment\PaymentMethodResource;
use Auth;

class PaymentMethodController extends Controller
{
    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            return response()->json([
                'methods' => PaymentMethodResource::collection(PaymentMethod::all())
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized'),
            ], 401);
        }
    }
}
