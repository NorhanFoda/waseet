@extends('web.layouts.app')
@section('title', trans('web.teachers'))
@section('description', trans('web.waseet_description'))
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

    <div class="container" data-aos="fade-in">
        <div class="job-title xs-center">
            <div class="row">
                <div class="col-sm-7 text-right-dir">
                    <h3 class="first_color">{{$title}}</h3>
                </div>
                @if(\Request::route()->getName() != 'teachers.get_by_type')
                    <div class="col-sm-5 text-left-dir">
                        {{-- <a href="#" data-toggle="modal" data-target="#teacher_register" id="register_teacher"  class="custom-btn text-center"> --}}
                            @if(!auth()->check())
                                <a href="#" @if(!Auth::check()) data-toggle="modal" data-target="#teacher_register" @endif id="register_teacher"  class="custom-btn text-center">
                                {{trans('web.do_register')}}
                            @endif
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="container text-center" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="row teachersWrap">
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
                                                        {{$teacher->materials[$i]->id == 4 && $teacher->materials[$i]->pivot->other_material != null ? $teacher->materials[$i]->pivot->other_material : $teacher->materials[$i]->{'name_'.session('lang')} }} @if($i < count($teacher->materials) && $i != (count($teacher->materials) - 1)) - @endif 
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
                                                <p>
                                                    @if($teacher->nationality_id != null)
                                                        {{ $teacher->nationality->{'name_'.session('lang')} }}
                                                    @else
                                                        {{ $teacher->nationality_id == 3 && $teacher->other_nationality != null ? $teacher->other_nationality : ''}}
                                                    @endif
                                                </p>
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
            </div>
        </div>
    </div>

    {{-- Register modal start --}}
    <div class="modal fade" id="teacher_register" tabindex="-1" role="dialog" aria-labelledby="teacher_register" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title first_color">{{trans('web.login_as')}} : </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right-dir">
                <div class="choose-login" data-aos="fade-in">
        
                @foreach($roles as $role)
                    @if($role->name == 'direct_teacher')
                    <div class="choose-login-link">
                        <a href="{{route('register.form', $role->id)}}"><i class="fa fa-user"></i>{{trans('web.direct_teacher')}}</a>
                    </div>
                    @endif
        
                    @if($role->name == 'online_teacher')
                    <div class="choose-login-link">
                        <a href="{{route('register.form', $role->id)}}"><i class="fa fa-user"></i>{{trans('web.online_teacher')}}</a>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
    {{-- Register modal end --}}

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#register_teacher').click(function(){
                if('{{Auth::check()}}'){
                    Swal.fire({
                        title: "{{trans('web.logout_first')}}",
                        type: 'warning',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        });
    </script>
@endsection