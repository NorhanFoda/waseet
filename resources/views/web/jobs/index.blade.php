@extends('web.layouts.app')
@section('title', trans('web.look_for_job'))
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
        <div class="job-title xs-center">
            <div class="row">
                <div class="col-sm-7 text-right-dir">
                    <h3 class="first_color">{{trans('web.look_for_job')}}</h3>
                </div>
                <div class="col-sm-5 text-left-dir">
                    <a href="{{route('register.user', 6)}}" id="register" class="custom-btn text-center">
                        {{trans('web.do_register')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="row teachersWrap main-items">
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
                                <p>{{$job->city->{'name_'.session('lang')} }} , {{$job->country->{'name_'.session('lang')} }}</p>
                            </li>
                        </ul>

                        <div class="teacher_contact">
                            <a href="{{route('jobs.apply', $job->id)}}">{{trans('web.apply')}}</a>
                        </div>
                    </div>
                </div>
                <!--end item-->
            @endforeach
        </div>
    </div>

@endsection

{{-- @if(Auth::check() && !Auth::user()->hasRole('job_seeker'))
    @section('scripts')
        <script>
            $(document).ready(function(){
                $('#register').click(function(){
                    Swal.fire({
                        title: "{{trans('web.logout_first')}}",
                        type: 'warning',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }); 
            });
        </script>
    @endsection
@endif --}}