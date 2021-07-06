@extends('web.layouts.app')
@section('title', trans('web.saved'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')
    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.saved')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.saved_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container" data-aos="fade-in">
        <div class="tabs-div">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                {{trans('web.jobs')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                {{trans('web.teachers')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> 
                                {{trans('web.bags')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">

                {{-- saved jobs tab content start --}}
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row teachersWrap main-items">
                        @foreach(auth()->user()->saved_jobs as $job)
                            <!--start item-->
                            <div class="item col-lg-4 col-sm-6">
                                @if($job->saveRef)
                                    <div class="teacher">
                                    <div class="teacher_info">
                                        <div class="teacher_img">
                                            <img src="{{asset('web/images/job.png')}}" alt="teacher image" />
                                        </div>
            
                                        <div class="teacher_name">
                                            <p>{{$job->saveRef->{'name_'.session('lang')} }}</p>
                                        </div>
                    
                                        <div class="bookmark custom-check-box">
                                            <a href="{{route('jobs.details', $job->saveRef->id)}}"><span> <i class="fas fa-plus"></i></span></a>
                                        </div>
                                    </div>
            
                                    <ul>
                                        <li>
                                            <p>{{$job->saveRef->work_hours}} {{trans('web.work_hours')}}</p>
                                        </li>
                                        <li>
                                            <p>{{$job->saveRef->exper_years}} {{trans('web.exper_years_2')}}</p>
                                        </li>
                                        <li>
                                            {{--<p>{{$job->saveRef->city->{'name_'.session('lang')} }} , {{$job->saveRef->country->{'name_'.session('lang')} }}</p>--}}
                                            <p>{{$job->saveRef->address }}</p>
                                        </li>
                                    </ul>
            
                                    <div class="teacher_contact">
                                        <a href="{{route('jobs.apply', $job->saveRef->id)}}">{{trans('web.apply')}}</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end item-->
                        @endforeach
                    </div>
                </div>
                {{-- saved jobs tab content end --}}

                {{-- saved teachers tab content start --}}
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row teachersWrap">
                        @foreach (auth()->user()->saved_teachers as $teacher)
                            @if($teacher->saveRef && !$teacher->saveRef->hasRole('admin'))
                                <!--start item-->  
                                <div class="item col-lg-4  col-sm-6">
                                    <div class="teacher">
                                        <div class="teacher_info">
                                            <div class="teacher_img">
                                                <img src="{{$teacher->saveRef->image ? $teacher->saveRef->image->path : asset('web/images/man.png')}}" alt="teacher image" />
                                            </div>
                                            <div class="teacher_name">
                                                <p>{{$teacher->saveRef->name}}</p>
                                                <h6>
                                                    @for($i = 0; $i < count($teacher->saveRef->materials); $i++)
                                                        {{$teacher->saveRef->materials[$i]->{'name_'.session('lang')} }} @if($i < count($teacher->saveRef->materials) && $i != (count($teacher->saveRef->materials) - 1)) - @endif 
                                                    @endfor
                                                </h6>
                                            </div>
                                            <div class="teacher_rate">
                                                @if($teacher->saveRef->ratings->count() > 0)
                                                    <form action="">
                                                        <input type="radio" id="st5" name="teacher" @if(ceil($teacher->saveRef->ratings->sum('rate') / $teacher->saveRef->ratings->count()) == 5) checked @endif />
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                        <input type="radio" id="st4" name="teacher" @if(ceil($teacher->saveRef->ratings->sum('rate') / $teacher->saveRef->ratings->count()) == 4) checked @endif />
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>      
                                                        <input type="radio" id="st3" name="teacher" @if(ceil($teacher->saveRef->ratings->sum('rate') / $teacher->saveRef->ratings->count()) == 3) checked @endif />
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st2" name="teacher" @if(ceil($teacher->saveRef->ratings->sum('rate') / $teacher->saveRef->ratings->count()) == 2) checked @endif />
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st1" name="teacher" @if(ceil($teacher->saveRef->ratings->sum('rate') / $teacher->saveRef->ratings->count()) == 1) checked @endif />
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

                                        <ul>
                                            <li>
                                                <p>{{$teacher->saveRef->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher')}}</p>
                                            </li>
                                            <li>
                                                <p>{{$teacher->saveRef->nationality->{'name_'.session('lang')} }}</p>
                                            </li>
                                            <li>
                                                <p>{{$teacher->saveRef->address}}</p>
                                            </li>
                                        </ul>

                                        <div class="teacher_contact">
                                            <a href="{{route('teachers.show', $teacher->saveRef->id)}}">{{trans('web.contact')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end item-->  
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- saved teachers tab content end --}}

                {{-- saved bags tab content start --}}
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        @foreach(auth()->user()->saved_bags as $bag)
                            <!--start item--> 
                            <div class="item col-lg-4 col-sm-6">
                                <div class="packsWrap">
                                    @if($bag->saveRef)
                                        <div class="pack m-2">
                                        <a href="{{$bag->saveRef ? route('web_bags.show', $bag->saveRef->id) : '#'}}">
                                            <div class="pack_img">
                                                @if($bag->saveRef)
                                                    <img src="{{$bag->saveRef->images()->where('image_type', 'slider')->first() ? $bag->saveRef->images()->where('image_type', 'slider')->first()->path : 'images/product-avatar.png'}}" alt="" />
                                                @endif
                                            </div>

                                            <div class="pack_name">
                                                <p>{{$bag->saveRef->{'name_'.session('lang')} }}</p>
                                            </div>

                                            <div class="about_pack">
                                                <p>
                                                    {!! $bag->saveRef->{'description_'.session('lang')} !!}
                                                </p>
                                            </div>

                                            <div class="pack_rate">
                                                <form action="">
                                                    @if($bag->saveRef && $bag->saveRef->ratings->count() > 0)
                                                        <input type="radio" id="st5" name="pack" @if(ceil($bag->saveRef->ratings->sum('rate') / $bag->saveRef->ratings->count()) == 5) checked @endif />
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st4" name="pack" @if(ceil($bag->saveRef->ratings->sum('rate') / $bag->saveRef->ratings->count()) == 4) checked @endif />
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st3" name="pack" @if(ceil($bag->saveRef->ratings->sum('rate') / $bag->saveRef->ratings->count()) == 3) checked @endif />
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st2" name="pack" @if(ceil($bag->saveRef->ratings->sum('rate') / $bag->saveRef->ratings->count()) == 2) checked @endif />
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st1" name="pack" @if(ceil($bag->saveRef->ratings->sum('rate') / $bag->saveRef->ratings->count()) == 1) checked @endif />
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
                                    @endif
                                </div>
                            </div>
                            <!--end item--> 
                        @endforeach
                    </div>
                </div>
                {{-- saved bags tab content end --}}
                
            </div>
        </div>
    </div>
@endsection