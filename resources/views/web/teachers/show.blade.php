@extends('web.layouts.app')
@section('title', $teacher->name)
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{$title}}</h5>
                    <p data-aos="fade-up">
                        {!! $text !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="teacher_info">
        <div class="container">
            <div class="info">
                <div class="img_name_rate">
                    <div class="teacher_img">
                        <img src="{{$teacher->image ? $teacher->image->path : asset('web/images/man.png')}}" alt="" />
                    </div>
                    <div class="teacher_name">
                        <p>{{$teacher->name}}</p>
                        <h6>
                            @for($i = 0; $i < count($teacher->materials); $i++)
                                {{$teacher->materials[$i]->{'name_'.session('lang')} }} @if($i < count($teacher->materials) && $i != (count($teacher->materials) - 1)) - @endif 
                            @endfor
                        </h6>
                    </div>
                    <div class="teacher_rate">
                        @if($teacher->ratings->count() > 0)
                            <form action="">
                                <input type="radio" id="st5" name="teacher" @if(ceil($teacher->ratings->sum('rate') / $teacher->ratings->count()) == 5) checked @endif />
                                <label for="st5">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input type="radio" id="st4" name="teacher" @if(ceil($teacher->ratings->sum('rate') / $teacher->ratings->count()) == 4) checked @endif />
                                <label for="st4">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>      
                                <input type="radio" id="st3" name="teacher" @if(ceil($teacher->ratings->sum('rate') / $teacher->ratings->count()) == 3) checked @endif />
                                <label for="st3">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>

                                <input type="radio" id="st2" name="teacher" @if(ceil($teacher->ratings->sum('rate') / $teacher->ratings->count()) == 2) checked @endif />
                                <label for="st2">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>

                                <input type="radio" id="st1" name="teacher" @if(ceil($teacher->ratings->sum('rate') / $teacher->ratings->count()) == 1) checked @endif />
                                <label for="st1">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                            </form>
                        @else
                            <form action="">
                                <input type="radio" id="st5" name="teacher" />
                                <label for="st5">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input type="radio" id="st4" name="teacher" />
                                <label for="st4">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>      
                                <input type="radio" id="st3" name="teacher" />
                                <label for="st3">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>

                                <input type="radio" id="st2" name="teacher" />
                                <label for="st2">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>

                                <input type="radio" id="st1" name="teacher" />
                                <label for="st1">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="teacher_contact custom-check-box">
                    <form action="">
                        <input type="checkbox" data-type="User" data-id="{{$teacher->id}}" id="bookmark" @if(Auth::check() && auth()->user()->saved_teachers->contains('saveRef_id', $teacher->id)) checked @endif />
                        <label for="bookmark">
                            <span> <i class="fas fa-bookmark"></i></span>
                        </label>
                    </form>
                    <a href="#">
                        <img src="{{asset('web/images/conversation.png')}}" alt="" />
                        {{trans('web.contact')}}
                    </a>
                </div>
                <div class="experience">
                    <div class="students">
                        <img src="{{asset('web/images/students.png')}}" alt="" />
                        <p>{{$teacher->hasRole('direct_teacher') ? trans('web.direct_teacher') : trans('web.online_teacher') }}</p>
                    </div>
                    <div class="students">
                        <img src="{{asset('web/images/rate.png')}}" alt="" />
                        <p>{{count($teacher->ratings) > 0 ? $teacher->ratings->sum('rate') / $teacher->ratings->count() : 0}} {{trans('web.rating')}}</p>
                    </div>
                    <div class="students">
                        <img src="{{asset('web/images/certificate.png')}}" alt="" />
                        <p>{{$teacher->exper_years}} {{trans('web.years')}}</p>
                    </div>
                </div>
                <div class="other_info">
                    <div class="phone_num">
                        <p>{{trans('web.edu_level')}} :</p>
                        <h6>{{$teacher->edu_level->{'name_'.session('lang')} }}</h6>
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.nationality')}} :</p>
                        <h6>{{$teacher->nationality->{'name_'.session('lang')} }}</h6>
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.age')}} :</p>
                        <h6>{{$teacher->age}} {{trans('web.year')}}</h6>
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.phone_main')}} :</p>
                        <a href="tel:{{$teacher->phone_main}}">{{$teacher->phone_main}}</a>
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.phone_secondary')}} :</p>
                        @if($teacher->phone_secondary)
                            <a href="tel:{{$teacher->phone_secondary}}">{{$teacher->phone_secondary}}</a>
                        @else
                            -
                        @endif
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.email')}} :</p>
                        <a href="mailto:{{$teacher->email}}">{{$teacher->email}}</a>
                    </div>
                    <div class="phone_num">
                        <p>{{trans('web.location')}} :</p>
                        <h6>{{$teacher->address}}</h6>
                    </div>
                    @if($teacher->hasRole('direct_teacher'))
                        <div class="phone_num">
                            <p>{{trans('web.teaching_address')}} :</p>
                            <h6>{{$teacher->teaching_address}}</h6>
                        </div>
                    @endif
                    <div class="about_teacher">
                        <h6>{{trans('web.teacher_bio')}}</h6>
                        <p>
                            {!! $teacher->{'bio_'.session('lang')} !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection