<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use App\Classes\SendEmail;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('status', '!=', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request){
        $order = Order::find($request->id);
        $order->update(['status' => $request->status]);

        if($request->status == 2){
            $order->bags()->update([
                'accepted' => Carbon::now()
            ]);
        }
        else if($request->status == 3){
            $order->bags()->update([
                'shipped' => Carbon::now()
            ]);
        }
        else if($request->status == 4){
            $order->bags()->update([
                'delivered' => Carbon::now()
            ]);

            // If order contains buy online bags, then send email bag contents
            if($order->bags()->where('buy_type', 1)->exists()){

                $bags = $order->bags()->where('buy_type', 1)->get();
                
                SendEmail::sendBagContents($bags, auth()->user()->email);

                // session()->flash('success', trans('web.bag_contents_emailed'));
                // return view('web.payment.payment_report', compact('order'));
            }
        }
    }

    public function show($id){
        $order = Order::with(['user', 'bags', 'address', 'receipt'])->find($id);

        return view('admin.orders.show', compact('order'));
    }
}
