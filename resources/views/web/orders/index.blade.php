@extends('web.layouts.app')
@section('title', trans('web.orders'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.orders')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.orders_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile margin-div text-right-dir">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="second_title second_color text-center" data-aos="fade-in">{{trans('web.orders')}}</h5>

                    <!--start edit-list-->
                    <div class="prof-edit-list order-list shipping-list">
                        <ul class="list-unstyled">
                            @foreach(Auth::user()->orders as $order)
                                <li class="gray-bg" data-aos="fade-up">
                                    <a href="{{route('profile.track_order', $order->id)}}" >{{trans('web.order_id')}} : {{$order->id}} 
                                        <i class="fa fa-ellipsis-h left-icon"></i>
                                    </a>
                                    <ul class="circle-list first_color">
                                        <li>{{trans('web.order_date')}} :
                                            <span class="second_color">{{$order->created_at->toDateString()}}</span>
                                        </li>
                                        <li>{{trans('web.count')}} : 
                                            <span class="second_color">{{$order->bags->count()}}</span>
                                        </li>
                                        <li> {{trans('web.total_price')}} : <span class="second_color"> {{$order->total_price +$order->shipping_fees }} {{trans('admin.sr')}} </span></li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--end edit-->
                </div>
            </div>
        </div>
    </section>

@endsection