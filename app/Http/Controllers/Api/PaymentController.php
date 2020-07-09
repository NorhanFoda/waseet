<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Setting;

class PaymentController extends Controller
{
    public function getPaymentForm(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            $this->validate($request, [
                'address_id' => 'required_if:buy_type,printcontent',
                'payment_method_id' => 'required', 
                'buy_type' => 'required',
            ]);

            // dd($request->all());

            $carts = auth()->user()->carts;
            
            $order_total_price = 0;

            foreach($carts as $cart){
                $order_total_price += $cart->total_price;
            }

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'total_price' => $order_total_price,
                'address_id' => $cart->buy_type == 'onlinebuy' ? null : $request->address_id,
                'status' => 1, // not confirmed
                'shipping_fees' =>  Setting::find(1)->shipping_fees,
                'buy_type' => $request->buy_type == 'onlinebuy' ? 1 : 2,
                'payment_method_id' => $request->payment_method_id
            ]);

            $cost = $order->total_price + $order->shipping_fees;
            $order_id = $order->id;

            return view('online_payment_form', compact('cost', 'order_id'));

        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized'),
            ], 401);
        }
    }
    
    public function payUrlApi($order_id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $id = $_GET['id'];
            $url = "https://test.oppwa.com/v1/checkouts/$id/payment";
            $url .= "?entityId=8ac7a4c9706822c7017070da753b0eec";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjN2E0Yzk3MDY4MjJjNzAxNzA3MGRhMjViOTBlZTh8ZnJubjhSeGJxVw=='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);

            $respone = json_decode($responseData, TRUE);
            $code = $respone['result']['code'];

            $success = [
                '000.000.000',
                '000.000.100',
                '000.100.110',
                '000.100.111',
                '000.100.112',
                '000.300.000',
                '000.300.100',
                '000.300.101',
                '000.300.102',
                '000.310.100',
                '000.310.101',
                '000.310.110',
                '000.600.000',
            ];
        
            $waiting_for_review = [
                '000.400.000',
                '000.400.010',
                '000.400.020',
                '000.400.040',
                '000.400.050',
                '000.400.060',
                '000.400.070',
                '000.400.080',
                '000.400.081',
                '000.400.082',
                '000.400.090',
                '000.400.100',
            ];
        
            $pending = [
                '000.200.000',
                '000.200.001',
                '000.200.100',
                '000.200.101',
                '000.200.102',
                '000.200.103',
                '000.200.200',
                '100.400.500',
                '800.400.500',
                '800.400.501',
                '800.400.502',
            ];

            $failed = [
                '000.400.101',
                '000.400.102',
                '000.400.103',
                '000.400.104',
                '000.400.105',
                '000.400.106',
                '000.400.107',
                '000.400.108',
                '000.400.109',
                '000.400.200',
            ];

            $order = Order::find($order_id);

            if(in_array($code, $success)){
                $order->update(['status' => 2]); // waiting
                return response()->json([
                    'success' => trans('api.success')
                ], 200);
            }
            else{
                
                return response()->json([
                    'error' => trans('api.error'),
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized'),
            ], 401);
        }
    }
}
