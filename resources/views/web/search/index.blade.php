@extends('web.layouts.app')
@section('title', trans('web.search_results'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down"> {{trans('web.search_results')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.profile_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container" data-aos="fade-in">
        <div class="row teachersWrap main-items">
            @if(count($bags) == 0 && count($jobs) == 0 && count($teachers) == 0)
                <div class="col-12 text-center">{{trans('web.no_search_results')}}</div>
            @endif
            @foreach($bags as $bag)
                <!--start item--> 
                <div class="item col-lg-4 col-sm-6">
                    <div class="packsWrap">
                        <div class="pack m-2">
                            <a href="{{route('web_bags.show', $bag->id)}}">
                                <div class="pack_img">
                                    <img src="{{$bag->images()->where('image_type', 'slider')->first() ? $bag->images()->where('image_type', 'slider')->first()->path : 'images/product-avatar.png'}}" alt="" />
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

            @foreach($jobs as $job)
                <!--start item-->
                <div class="item col-lg-4 col-sm-6">
                    <div class="teacher">
                        <div class="teacher_info">
                            <div class="teacher_img">
                                <img src="{{asset('web/images/job.png')}}" alt="teacher image" />
                            </div>

                            <div class="teacher_name">
                                <p>{{$job->{'name_'.session('lang')} }}</p>
                                <h6>{{$job->specialization->{'name_'.session('lang')} }}</h6>
                            </div>


                            <div class="bookmark custom-check-box">
                                {{-- <form action="{{route('jobs.details', $job->id)}}">
                                    <input type="checkbox" id="bookmark" />
                                    <label for="bookmark">
                                        <span> <i class="fas fa-plus"></i></span>
                                    </label>
                                </form> --}}
                                <a href="{{route('jobs.details', $job->id)}}"><span> <i class="fas fa-plus"></i></span></a>
                            </div>
                        </div>

                        <ul>
                            <li>
                                <p>{{$job->work_hours}} {{trans('web.work_hours')}}</p>
                            </li>
                            <li>
                                <p>{{$job->exper_years}} {{trans('web.exper_years_2')}}</p>
                            </li>
                            <li>
                                {{-- <p>{{$job->city->{'name_'.session('lang')} }} , {{$job->country->{'name_'.session('lang')} }}</p> --}}
                                <p>{{$job->address}}</p>
                            </li>
                        </ul>

                        <div class="teacher_contact">
                            <a href="{{route('jobs.apply', $job->id)}}">{{trans('web.apply')}}</a>
                        </div>
                    </div>
                </div>
                <!--end item-->
            @endforeach

            @foreach ($teachers as $teacher)
                @if(!$teacher->hasRole('admin'))
                    <!--start item-->  
                    <div class="item col-lg-4  col-sm-6">
                        <div class="teacher">
                            <div class="teacher_info">
                                <div class="teacher_img">
                                    <img src="{{$teacher->image ? $teacher->image->path : asset('web/images/man.png')}}" alt="teacher image" />
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

                            <ul>
                                <li>
                                    <p>{{$teacher->hasRole('online_teacher') ? trans('web.online_teacher') : trans('web.direct_teacher')}}</p>
                                </li>
                                <li>
                                    <p>{{$teacher->nationality->{'name_'.session('lang')} }}</p>
                                </li>
                                <li>
                                    <p>{{$teacher->address}}</p>
                                </li>
                            </ul>

                            <div class="teacher_contact">
                                <a href="{{route('teachers.show', $teacher->id)}}">{{trans('web.contact')}}</a>
                            </div>
                        </div>
                    </div>
                    <!--end item-->  
                @endif
            @endforeach
        </div>
    </div>
@endsection