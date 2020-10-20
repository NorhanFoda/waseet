@extends('web.layouts.app')
@section('title', trans('web.job_seekers'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.job_seekers')}}</h5>
                    <p data-aos="fade-up">{{trans('web.job_seekers_text')}}</p>
                </div>
            </div>
        </div>
    </section> 

    <div class="container" data-aos="fade-in">
        <div class="job-title xs-center">
            <div class="row">
                <div class="col-sm-7 text-right-dir">
                    <h3 class="first_color">{{trans('web.job_seekers')}}</h3>
                </div>
            </div>
        </div>
        <div class="container text-center" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="row teachersWrap">
                        @foreach ($seekers as $seeker)
                            @if(!$seeker->hasRole('admin'))
                                <!--start item-->  
                                <div class="item col-lg-4  col-sm-6">
                                    <div class="teacher">
                                        <div class="teacher_info">
                                            <div class="teacher_img">
                                                <img src="{{$seeker->image!= null ? $seeker->image->path : asset('web/images/man.png')}}" alt="teacher image" />
                                            </div>
                                            <div class="teacher_name">
                                                <p>{{$seeker->name}}</p>
                                                <h6>
                                                    <a href="{{$seeker->document != null ? $seeker->document->path : asset('web/images/man.png')}}">{{trans('web.cv')}}</a>
                                                </h6>
                                            </div>
                                        </div>

                                        <ul>
                                            <li><p>{{trans('web.email')}}: {{$seeker->email}}</p></li>
                                            <li><p>{{trans('web.salary')}}: {{$seeker->salary_month}} {{trans('admin.sr')}}</p></li>
                                            <li><p>{{$seeker->exper_years}} {{trans('web.years')}}</p></li>
                                        </ul>

                                        <div class="teacher_contact">
                                            <a href="{{route('profile.show', $seeker->id)}}">{{trans('web.view')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end item-->  
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection