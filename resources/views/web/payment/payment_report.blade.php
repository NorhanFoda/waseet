@extends('web.layouts.app')
@section('title', trans('web.payment_report'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

        <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">{{trans('web.payment_report')}}</h5>
                        <p data-aos="fade-up">
                            {{trans('web.payment_report_text')}}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile margin-div text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="second_title second_color text-center" data-aos="fade-in">{{trans('web.payment_status')}}</h5>

                        <div class="white-payment text-right-dir">
                            <div class="row">
                                <div class="col-12 payment-grid">
                                    <ul>
                                        <li><span> {{trans('web.order_id')}} :</span> {{$order->id}}</li>
                                        <li><span>  {{trans('web.cost')}} :</span>  {{$order->total_price + $order->shipping_fees}} {{trans('admin.sr')}}</li>
                                        <li><span>  {{trans('web.address')}} :</span>   {{$order->address->country->{'name_'.session('lang')} }} - {{$order->address->city->{'name_'.session('lang')} }} - {{$order->address->address}}</li>
                                    </ul>
                                    <div class="text-center col-12">
                                       <br><br>  <a href="{{route('profile.orders')}}" class="custom-btn">{{trans('web.continue')}} </a>
                                    <br><br>
                                </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection