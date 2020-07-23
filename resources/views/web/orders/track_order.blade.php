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
                            <li class="gray-bg" data-aos="fade-up"><a href="#">{{trans('web.order_id')}} : {{$order->id}}
                                <i class="fa fa-ellipsis-h left-icon"></i></a>

                                <!--start product-->
                                @foreach($order->bags as $bag)
                                    <div class="packsWrap book-details">
                                        <div class="pack_img md-center">
                                            <img src="{{$bag->image}}" alt="" />
                                        </div>

                                        <div class="pack-width">
                                            <div class="pack_name">
                                                <p>{{$bag->{'name_'.session('lang')} }} 
                                                    {{-- if order is confirmed then user can show bag contents --}}
                                                    @if($bag->pivot->buy_type == 1) (<a href="{{$order->status != 1 ? route('order.bag_contents', $order->id) : '#'}}">{{trans('web.buy_online')}}</a>) @endif
                                                    @if($bag->pivot->buy_type == 2) ({{trans('web.print_content')}}) @endif
                                                </p>
                                            </div>

                                            <div class="pack_rate">
                                                <form action="">
                                                    @if($bag->ratings->count() > 0)
                                                        <input type="radio" id="st5" name="pack" @if(ceil($bag->ratings->sum('rate') / $bag->ratings->count()) == 5) checked @endif />
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st4" name="pack" @if(ceil($bag->ratings->sum('rate') / $bag->ratings->count()) == 4) checked @endif />
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st3" name="pack" @if(ceil($bag->ratings->sum('rate') / $bag->ratings->count()) == 3) checked @endif />
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st2" name="pack" @if(ceil($bag->ratings->sum('rate') / $bag->ratings->count()) == 2) checked @endif />
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st1" name="pack" @if(ceil($bag->ratings->sum('rate') / $bag->ratings->count()) == 1) checked @endif />
                                                        <label for="st1">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @else
                                                        <input type="radio" id="st5" name="pack"/>
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st4" name="pack"/>
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st3" name="pack"/>
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st2" name="pack"/>
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
            
                                                        <input type="radio" id="st1" name="pack"/>
                                                        <label for="st1">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @endif
                                                </form>
                                            </div>

                                            <div class="det-list first_color">
                                                <div>{{trans('web.count')}} : <span class="second_color">{{$bag->pivot->quantity}}</span></div>
                                                <div>{{trans('web.sub_price')}} : <span class="second_color"> {{$bag->pivot->total_price}} {{trans('admin.sr')}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!--end product-->

                            </li>


                        </ul>
                    </div>
                    <!--end edit-->

                    <!--start track-order-->
                    @if($order->bags()->where('buy_type', 2)->exists())
                        <div class="track-order margin-div"  data-aos="fade-up">
                            <ul class="list-unstyled">
                                <li @if($order->status == 2 || $order->status == 3 || $order->status == 4) class="active" @endif>
                                    <div class="track-img"><img src="{{asset('web/images/track-1.png')}}" alt="track"></div>
                                    <div class="side-track">
                                        <h3>{{trans('web.bag_is_ordered')}}</h3>
                                        @if($order->status == 2 || $order->status == 3 || $order->status == 4)
                                            {{trans('web.order_waiting')}} {{$order->receipt->created_at->toDateString()}}
                                        @endif
                                        @if($order->status == 1)
                                            {{trans('web.order_not_confirmed')}} <a href="{{route('order.confirm', $order->id)}}">{{trans('web.confirm_order')}}</a>
                                        @endif
                                    </div>
                                </li>

                                <li @if($order->status == 3 || $order->status == 4) class="active" @endif>
                                    <div class="track-img"><img src="{{asset('web/images/track-3.png')}}" alt="track"></div>
                                    <div class="side-track">
                                        <h3>{{trans('web.order_shipped')}}</h3>
                                        @if($order->status == 3 || $order->status == 4)
                                            {{trans('web.order_is_shipped')}} {{date('Y-m-d', strtotime($bag->pivot->shipped ?? ''->Fecha))}}
                                        @else
                                            {{trans('web.ordered_not_shipped')}}
                                        @endif
                                    </div>
                                </li>

                                <li @if($order->status == 4) class="active" @endif>
                                    <div class="track-img"><img src="{{asset('web/images/track-2.png')}}" alt="track"></div>
                                    <div class="side-track">
                                        <h3>{{trans('web.order_delivered')}}</h3>
                                        @if($order->status == 4)
                                            {{trans('web.order_is_delivered')}} {{date('Y-m-d', strtotime($bag->pivot->delivered ?? ''->Fecha))}}
                                        @else
                                            {{trans('web.order_not_delivered')}}
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <!--end track-order-->

                </div>
            </div>
        </div>
    </section>

@endsection