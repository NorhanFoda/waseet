@extends('web.layouts.app')
@section('title', trans('admin.home'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')
@include('web.layouts.slider')
<section class="feature-text" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-offset="200">
    <div class="container">
      <h5>
        {!! $set->{'text_before_add_'.session('lang')} !!}
        <h3 id="shadow">
          {!! $set->{'text_before_add_'.session('lang')} !!}
        </h3>
      </h5>

    </div>
  </section>

  <section class="ad-space" data-aos="fade-in">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="ad">

          <img src="{{asset('/images/ad.png')}}" alt="" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="wrapper">
    <div class="container">
      <div class="row">

        <div class="logo col-lg-3 col-sm-4" data-aos="fade-in">
          <img src="{{$set->text_after_add_image}}" alt="" />
          <img src="{{asset('/images/logo2.png')}}" alt="" />
        </div>
        <div class="text col-lg-9 col-sm-8" data-aos="fade-in">
          <p>
            {!! $set->{'text_after_add_'.session('lang')} !!}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="search-job">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="title" data-aos="fade-down">
          <h5>{{$set->{'section_1_title_'.session('lang')} }}</h5>
          <h5>{!! $set->{'section_1_text_'.session('lang')} !!}</h5>
        </div>
      </div>

      <div class="row">

        <div class="job col-md-4 col-sm-6" data-aos="slide-up" data-aos-offset="300">
          <img src="{{$set->step_1_image}}" alt="" />
          <h5>{{$set->{'step_1_title_'.session('lang')} }}</h5>
          <p>
           {!! $set->{'step_1_text_'.session('lang')} !!}
          </p>
        </div>

        <div class="job col-md-4 col-sm-6" data-aos="slide-up" data-aos-offset="300">
          <img src="{{$set->step_2_image}}" alt="" />
          <h5>{{$set->{'step_2_title_'.session('lang')} }}</h5>
          <p>
           {!! $set->{'step_2_text_'.session('lang')} !!}
          </p>
        </div>

        <div class="job col-md-4 col-sm-6" data-aos="slide-up" data-aos-offset="300">
          <img src="{{$set->step_3_image}}" alt="" />
          <h5>{{$set->{'step_3_title_'.session('lang')} }}</h5>
          <p>
           {!! $set->{'step_3_text_'.session('lang')} !!}
          </p>
        </div>

      </div>
    </div>
  </section>

  <section class="private-teacher text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="title" data-aos="fade-down">
            <h5>{{$set->{'section_2_title_'.session('lang')} }} </h5>
            <h5>
              {!! $set->{'section_2_text_'.session('lang')} !!}
            </h5>
          </div>
        </div>
      </div>

      <div class="row" style="justify-content: center">
        <div class="teacher  col-md-4 col-sm-6" data-aos="slide-up" data-aos-offset="300">
          <img src="{{$set->online_teacher_image}}" alt="" />
          <h5>{{$set->{'online_teacher_title_'.session('lang')} }}</h5>
          <p>
            {!! $set->{'online_teacher_text_'.session('lang')} !!}
          </p>

          <a href="{{route('teachers.get_by_type', 'online')}}" class="custom-btn">{{trans('web.more')}}</a>
        </div>

        <div class="teacher col-md-4 col-sm-6" data-aos="slide-up" data-aos-offset="300">
          <img src="{{$set->direct_teacher_image}}" alt="" />
          <h5>{{$set->{'direct_teacher_title_'.session('lang')} }}</h5>
          <p>
            {!! $set->{'direct_teacher_text_'.session('lang')} !!}
          </p>
          <a href="{{route('teachers.get_by_type', 'direct')}}" class="custom-btn">{{trans('web.more')}}</a>
        </div>
      </div>
    </div>

  </section>

  <section class="packs text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="title" data-aos="fade-down">
            <h5>{{$set->{'section_3_title_'.session('lang')} }}</h5>
            <h5>
              {!! $set->{'section_3_text_'.session('lang')} !!}
            </h5>
          </div>
        </div>
      </div>
      <div class="owl-carousel owl-theme justify-content-around" id="owl2">

        @foreach($cats as $cat)
          <!--start item-->
          <div class="item">
            <div class="pack">
              <div class="img">
                <img src="{{$cat->image->path}}" alt="" />
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
  </section>
@endsection