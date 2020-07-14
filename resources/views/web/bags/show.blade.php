@extends('web.layouts.app')
@section('title', \App::getLocale() == 'ar' ? $bag->name_ar : $bag->name_en)
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')
    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down"> {{$title}}</h5>
                    <p data-aos="fade-up">
                        {!! $text !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!--start packsWrap-->
        <div class="packsWrap book-details" data-aos="fade-in">
            <div class=" m-2">

                <div class="row">
                    <div class="pack_img col-lg-3 md-center">
                        <img src="{{$bag->image}}" alt="" />
                    </div>

                    <div class="col-lg-7 col-sm-10">
                        <div class="pack-width">
                            <div class="pack_name">
                                <p>{{$bag->{'name_'.session('lang')} }}</p>
                                <span class="pack_price">{{$bag->price}} {{trans('admin.sr')}}</span>
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
                            <div class="about_pack text-right-dir">
                                <p>{!! $bag->{'description_'.session('lang')} !!}</p>
                            </div>
                            <div class="two-btns text-center">
                                <a href="#" class="custom-btn"><i class="fa fa-undo"></i>{{trans('web.print_content')}}</a>
                                <a href="cart.html" class="custom-btn"><i class="fa fa-cart-plus"></i>{{trans('web.buy_online')}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="book-share col-sm-2 text-left-dir">
                        <div class="custom-check-box text-left-dir">
                            <form action="">
                                <input type="checkbox" id="bookmark" />
                                <label for="bookmark">
                                    <span> <i class="fas fa-bookmark"></i></span>
                                </label>
                            </form>
                        </div>
                        <span class="first_color">{{trans('web.share')}}</span>
                        <div class="social-icons footer-social">
                            <a href="#" class="fc"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="tw"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="nst"><i class="fab fa-instagram"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end packsWrap-->

        <!--start packsWrap-->
        <div class="book-details-next text-right-dir" data-aos="fade-in">
            <div class="m-2">

                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="first_color"><i class="fa fa-book"></i>{{trans('web.bag_contents')}} :</h3>
                        <ul class="list-unstyled second_color circle-list">
                            {!! $bag->{'contents_'.session('lang')} !!}
                        </ul>
                    </div>

                    <div class="col-lg-6">
                        <video width="100%" height="290" poster="{{$bag->poster}}" controls>
                            <source src="{{$bag->video}}" type="video/mp4">
                            <source src="{{$bag->video}}" type="video/ogg">
                            <source src="{{$bag->video}}" type="video/webm">
                        </video>
                    </div>

                </div>
            </div>
        </div>
        <!--end packsWrap-->

    </div>
@endsection