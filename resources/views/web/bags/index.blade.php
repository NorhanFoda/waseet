@extends('web.layouts.app')
@section('title', trans('admin.bags'))
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

    <div class="container" data-aos="fade-in">
        <div class="row">
            @foreach($bags as $bag)
                <!--start item--> 
                <div class="item col-lg-4 col-sm-6">
                    <div class="packsWrap">
                        <div class="pack m-2">
                            <a href="{{route('bags.show', $bag->id)}}">
                                <div class="pack_img">
                                    <img src="{{$bag->image}}" alt="" />
                                </div>

                                <div class="pack_name">
                                    <p>{{$bag->{'name_'.session('lang')} }}</p>
                                </div>

                                <div class="about_pack">
                                    <p>
                                        {!! $bag->{'description_'.session('lang')} !!}
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
                            </a>
                        </div>
                    </div>
                </div>
                <!--end item--> 
            @endforeach
        </div>
    </div>
@endsection