<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use App\Classes\SendEmail;
// use App\Jobs\SendEmailJob;

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
                // $details['email'] = auth()->user()->email;
                // $details['bags'] = $order->bags()->where('buy_type', 1)->get();
                // $details['type'] = 'send_bag_contents';
                // dispatch(new SendEmailJob($details));
                SendEmail::sendBagContents($order->bags()->where('buy_type', 1)->get(), auth()->user()->email);
            }
        }
    }

    public function show($id){
        $order = Order::with(['user', 'bags', 'address', 'receipt'])->find($id);

        return view('admin.orders.show', compact('order'));
    }
}
