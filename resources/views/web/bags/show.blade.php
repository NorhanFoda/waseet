@extends('web.layouts.app')

@section('meta')
    {{-- Faceboon meta tages start --}}
    <meta property="og:title" content="{{$bag->{'name_'.session('lang')} }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{$bag->image}}" />
    <meta property="og:image:url"  content="{{$bag->image}}" />
    <meta property="og:image:width"  content="500" />
    <meta property="og:image:height"  content="314" />
    <meta property="og:description" content="<?=strip_tags($bag->{'description_'.session('lang')} )?>" />
    <meta property="og:site_name" content="{{trans('admin.waseet')}}" />
    <meta property="og:url" content="{{route('bags.show',$bag->id)}}" />
    {{-- Facebook meta tage end --}}
    
    {{-- Twitter meta tags start --}}
    <meta name="twitter:title" content="{{$bag->{'name_'.session('lang')} }}">
    <meta name="twitter:description" content="{{$bag->{'description_'.session('lang')} }}">
    <meta name="twitter:image" content="{{$bag->image}}">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{trans('admin.waseet')}}" />
    <meta name="twitter:creator" content="www.jaadara.com" />
    {{-- Twitter meta tags end --}}
@endsection

@section('title', \App::getLocale() == 'ar' ? $bag->name_ar : $bag->name_en)
@section('description', \App::getLocale() == 'ar' ? $bag->description_ar : $bag->description_en)
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
                                <a href="#" onclick="addToCart(2)" class="custom-btn"><i class="fa fa-undo"></i>{{trans('web.print_content')}}</a>
                                <a href="#" onclick="addToCart(1)" class="custom-btn"><i class="fa fa-cart-plus"></i>{{trans('web.buy_online')}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="book-share col-sm-2 text-left-dir">
                        <div class="custom-check-box text-left-dir">
                            <form action="">
                                <input type="checkbox" data-type="Bag" data-id="{{$bag->id}}" id="bookmark" @if(Auth::check() && auth()->user()->saved_bags->contains('saveRef_id', $bag->id)) checked @endif />
                                <label for="bookmark">
                                    <span> <i class="fas fa-bookmark"></i></span>
                                </label>
                            </form>
                        </div>
                        <span class="first_color">{{trans('web.share')}}</span>
                        <div class="social-icons footer-social">
                            <div data-network="facebook" class="st-custom-button fc fab fa-facebook-f"></div>
                            <div data-network="twitter" class="st-custom-button  tw fab fa-twitter"></div>
                            <div data-network="whatsapp" class="st-custom-button  wts fab fa-whatsapp"></div>
                            {{-- <div data-network="sharethis" class="st-custom-button fa fa-share-alt"></div> --}}
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
    
          <!--start packsWrap-->
        <div class="book-details-next book-details-next2 text-right-dir" data-aos="fade-in">
            <div class="container"> 
                <div class="m-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="first_color"><i class="fa fa-star"></i>{{trans('web.bag_benefits')}} :</h3>
                            <ul class="list-unstyled second_color circle-list">
                                {!! $bag->{'benefits_'.session('lang')} !!}
                            </ul>
                        </div>

                        <div class="col-lg-6 text-center">
                            <img src="{{asset('web/images/book3.png')}}" alt="img"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end packsWrap-->
@endsection

@section('scripts')
    <script>
        function addToCart(buy_type){
            if(!'{{Auth::check()}}'){
                Swal.fire({
                    title: "{{trans('web.do_login_2')}}",
                    type: 'warning',
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
            else{
                $.ajax({
                    url: "{{route('carts.store')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", 
                            bag_id: '{{$bag->id}}',
                            quantity: 1,
                            total_price: '{{$bag->price}}',
                            buy_type: buy_type },
                    success: function(data){
                        // Save carts to localStorage
                        localStorage.setItem("carts", JSON.stringify(@json(auth()->user()->carts)));
                        var carts = JSON.parse(localStorage.getItem("carts"));
                        var item = {
                            id: data['id'],
                            user_id: '{{auth()->user()->id}}',
                            bag_id: '{{$bag->id}}',
                            quantity: 1,
                            total_price: '{{$bag->price}}',
                            buy_type: buy_type
                        }

                        if(carts == null){
                            carts = [];
                            carts.push(item);
                            localStorage.setItem("carts", JSON.stringify(carts));
                        }
                        else{
                            carts.push(item);
                            localStorage.setItem("carts", JSON.stringify(carts));
                        }

                        console.log(carts);

                    Swal.fire({
                        title: data['msg'],
                        type: 'success',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    }
                });
            }
        }
    </script>
@endsection