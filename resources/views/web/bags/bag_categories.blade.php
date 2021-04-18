@extends('web.layouts.app')
@section('title', trans('admin.bags'))
@section('description', trans('web.waseet_description'))
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
        <div class="row justify-content-around cat-bags">
               @foreach($cats as $cat)
                <!--start item--> 
                <div class="item col-lg-4 col-sm-6">
            <div class="pack">
              <div class="img">
                <img src="{{$cat->image ? $cat->image->path : ''}}" alt="{{$cat->image ? $cat->image->path : trans('web.no_image')}}" />
              </div>
              <div class="row">
                <a href="{{route('categories.bags', $cat->id)}}" class="custom-btn">{{$cat->{'name_'.session('lang')} }}</a>
              </div>
            </div>
          </div>
                <!--end item--> 
        @endforeach
      
     
        </div>
    </div>
@endsection