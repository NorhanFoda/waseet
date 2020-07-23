<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

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
        }
    }
}
