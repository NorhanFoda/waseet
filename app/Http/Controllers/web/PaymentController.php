<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Order;
use App\Models\BagOrder;
use App\Models\Bag;
use App\Models\Bank;
use App\Models\BankReceipt;
use App\Models\Image;
use App\Classes\Upload;
use App\Classes\SendEmail;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function prepareOrder($address_id){
        $carts = auth()->user()->carts;
        
        if(count($carts) == 0){
            session()->flash('error', trans('web.cart_empty'));
            return redirect()->back();
        }

        $shipping_fees = Setting::find(1)->shipping_fees;

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => $carts->sum('total_price'),
            'address_id' => $address_id,
            'status' => 1, // Not confirmed
            'shipping_fees' => $shipping_fees,
        ]);
        
        foreach($carts as $cart){
            $bag = Bag::findOrFail($cart->bag_id);
            $order->bags()->attach($bag);
            BagOrder::where('bag_id', $cart->bag_id)->first()->update([
                'total_price' => $cart->total_price,
                'quantity' => $cart->quantity,
                'buy_type' => $cart->buy_type
            ]);
            
            $cart->delete();
        }

        $banks = Bank::all();
        return view('web.payment.payment')->with(['order_id' => $order->id, 'banks' => $banks]);
    }

    public function getBanksData(){
        $banks = Bank::with('image')->get();
        return view('web.payment.payment_methods', compact('banks'));
    }

    public function saveBankReceipt(Request $request){
        $this->validate($request, [
            'bank_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cost' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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

            session()->flash('success', trans('web.bag_contents_emailed'));
            return view('web.payment.payment_report', compact('order'));
        }
        
        return view('web.payment.payment_report', compact('order'));
    }

    public function confirmOrder($id){
        $banks = Bank::all();
        return view('web.payment.payment')->with(['order_id' => $id, 'banks' => $banks]);
    }
}
