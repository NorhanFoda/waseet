@extends('web.layouts.app')
@section('title', \App::getLocale() == 'ar' ? $page->name_ar : $page->name_en)
@section('description', \App::getLocale() == 'ar' ? $page->short_description_ar : $page->short_description_en)
@section('image', asset('/images/logo.png'))

@section('content')
    <section class="helpCenter text-center">
        <div class="container">
        <div class="row">
            <div class="col-12">
            <h5 data-aos="fade-down">{{$page->{'name_'.session('lang')} }}</h5>
            <p data-aos="fade-up">
                {!! $page->{'short_description_'.session('lang')} !!}
            </p>
            </div>
        </div>
        </div>
    </section>

    @if($page->id == 1)
      <section class="aboutus_wrapper text-right-dir" data-aos="fade-in">
        <div class="wrapper" data-aos="fade-in">
          <div class="container">
            <div class="row">
              <h5 class="col-12 text-center">{{$page->{'name_'.session('lang')} }}</h5>
              <div class="logo col-lg-3 col-sm-4" data-aos="fade-in">
                <img src="./images/Vector-Smart-Object1.png" alt="" />
                <img src="./images/وسيط-المعلم.png" alt="" />
              </div>
              <div class="text col-lg-9 col-sm-8" data-aos="fade-in">
                <p>{!! $page->{'short_description_'.session('lang')} !!}</p>
              </div>
            </div>
          </div>
        </div>
  
        <div class="container xs-center">
          <div class="about-div" data-aos="fade-up">
            <div class="row">
              <div class="col-md-2 col-sm-3">
                <div class="circle-title">{{trans('web.vision')}} :</div>
              </div>
              <div class="about-prg col-md-10 col-sm-9">{!! $page->{'vision_'.session('lang')} !!}</div>
            </div>
          </div>
          <div class="about-div" data-aos="fade-up">
            <div class="row">
              <div class="col-md-2 col-sm-3">
                <div class="circle-title">{{trans('web.message')}} :</div>
              </div>
              <div class="about-prg col-md-10 col-sm-9">
                {!! $page->{'message_'.session('lang')} !!}
              </div>
            </div>
          </div>
  
          <div class="about-div multi-about" data-aos="fade-up">
            <div class="row">
              <div class="col-12">
                <div class="circle-title">{{trans('web.goals_of_app_depts')}} :</div>
              </div>
  
              @foreach($page->goals as $goal)
                <div class="col-xl-3 col-lg-4  col-md-5">
                  <div class="circle-title">{{$goal->{'title_'.session('lang')} }} :</div>
                </div>
                <div class="about-prg col-xl-9 col-lg-8 col-md-7">{!! $goal->{'text_'.session('lang')} !!}</div>
              @endforeach
  
            </div>
          </div>
        </div>
      </section>
    @else
      <section class="aboutus_wrapper text-center" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>{{$page->{'title_'.session('lang')} }}</h5>
                    <p>{!! $page->{'full_description_'.session('lang')} !!}</p>
                </div>
            </div>
        </div>
      </section>
    @endif

@endsection