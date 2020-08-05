@extends('web.layouts.app')
@section('title', $job->{'name_'.session('lang')} )
@section('description', \App::getLocale() == 'ar' ? $job->description_ar : $job->description_en)
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
            <div class="img_name_rate">
              <div class="teacher_img">
                <img src="{{asset('web/images/job.png')}}" alt="" />
              </div>

              <div class="teacher_name">
                <p>{{$job->{'name_'.session('lang')} }}</p>
                <h6>{{$job->specialization->{'name_'.session('lang')} }}</h6>
              </div>
            </div>

            <div class="teacher_contact text-left-dir custom-check-box">
              <form action="">
                <input type="checkbox" data-type="Job" data-id="{{$job->id}}" id="bookmark" @if(auth()->user()->saved_jobs->contains('saveRef_id', $job->id)) checked @endif />
                <label for="bookmark">
                  <span> <i class="fas fa-bookmark"></i></span>
                </label>
              </form>

              @if(auth()->user()->hasRole('organization'))
                <form action="">
                  <input type="checkbox" />
                  <label for="bookmark">
                    <a href="{{route('jobs.edit_job', $job->id)}}"><span> <i class="fas fa-edit"></i></span></a>
                  </label>
                </form>
              @endif
            </div>

            <div class="other_info">
              <div class="phone_num">
                <p>{{trans('web.work_hours_count')}} :</p>
                <h6>{{$job->work_hours}} {{trans('web.work_hours')}}</h6>
              </div>

              <div class="phone_num">
                <p>{{trans('web.exper_years')}} :</p>
                <h6>{{$job->exper_years}} {{trans('web.years')}}</h6>
              </div>

              <div class="phone_num">
                <p>{{trans('web.location')}} :</p>
                <h6>{{$job->city->{'name_'.session('lang')} }} , {{$job->country->{'name_'.session('lang')} }}</h6>
              </div>

              <div class="phone_num">
                <p>{{trans('web.required_number')}} :</p>
                <h6>{{$job->required_number}} {{trans('web.teachers')}}</h6>
              </div>

              <div class="phone_num">
                <p>{{trans('web.free_places')}} :</p>
                <h6>{{$job->free_places}} {{trans('web.place')}}</h6>
              </div>

              <div class="about_teacher">
                <h6>{{trans('web.job_description')}}</h6>
                <p>
                  {!! $job->{'description_'.session('lang')} !!}
                </p>
              </div>

              <div class="reserve">
                <a href="{{route('jobs.apply', $job->id)}}" class="custom-btn">{{trans('web.apply_to_job')}}</a>
              </div>
            </div>
          </div>
        </div>
      </section>

@endsection