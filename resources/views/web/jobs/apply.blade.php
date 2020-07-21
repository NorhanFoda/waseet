@extends('web.layouts.app')
@section('title', trans('web.apply_to_job'))
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

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="{{route('jobs.update_seeker')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="inputs-contain">
                                <div class="big-label">{{trans('web.full_name')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" name="name" value="{{auth()->user()->name}}" required />

                                </div>

                                <div class="big-label">{{trans('web.email')}}</div>
                                <div class="userName">
                                    <input type="email" id="mail" name="email" disabled value="{{auth()->user()->email}}" required />

                                </div>

                                <div class="big-label">{{trans('web.phone_main')}}</div>
                                <div class="userName">
                                    <input type="tel" id="mob" name="phone_main" value="{{auth()->user()->phone_main}}" required />

                                </div>

                                <div class="big-label">{{trans('web.phone_secondary')}}</div>
                                <div class="userName">
                                    <input type="tel" id="mob" name="phone_secondary" value="{{auth()->user()->phone_secondary}}" />

                                </div>

                                <div class="big-label">{{trans('web.address')}}</div>
                                <div class="userName">
                                    <input type="text" id="country" name="address" value="{{auth()->user()->address}}" required />

                                </div>


                                <div class="big-label">{{trans('web.applied_job')}}</div>
                                <div class="userName">
                                    <select name="job_id" class="form-control" required>
                                        <option value="{{null}}">{{trans('web.applied_job')}}</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{$job->id}}" @if($job->id == $job_id) selected @endif>{{$job->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="big-label">{{trans('web.exper_years')}}</div>
                                <div class="userName">
                                    <input type="number" id="confirm" name="exper_years" value="{{auth()->user()->exper_years}}" required />

                                </div>

                                <div class="big-label">{{trans('web.salary')}}</div>
                                <div class="userName">
                                    <input type="number" id="confirm2" name="salary" value="{{auth()->user()->salary_month}}" required />

                                </div>

                                <div class="big-label">{{trans('web.cv')}} : </div>
                                <div class="userName custom-file">
                                    <input type="file" id="file-up" accept="application/pdf" name="cv" required />
                                    <label for="file-up">
                                        <i class="fa fa-upload"></i> <span></span>
                                    </label>
                                </div>

                                @if(auth()->user()->document != null)
                                    <div class="userName custom-file">
                                        <a href="{{auth()->user()->document->path}}">{{trans('web.view_cv')}}</a>
                                    </div>
                                @endif

                            </div>

                            <div class="submit">
                                <button type="submit" class="custom-btn">{{trans('web.send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection