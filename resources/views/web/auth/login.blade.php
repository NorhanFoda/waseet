@extends('web.layouts.register')
@section('title', trans('web.login'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

    <div class="background"></div>

    <div class="cardBody">
        <div class="goSignUp" data-aos="fade-in">
            <div class="logo">
                <img src="{{asset('web/images/Vector-Smart-Object2.png')}}" alt="" />
            </div>

            <div class="welcome">
                <p>
                    {{$welcome_text}}
                </p>
            </div>

            <div class="login-btn">
                <a href="#" data-toggle="modal" data-target="#login-choose" class="white-btn">{{trans('web.register')}}</a>
            </div>
        </div>

        <div class="logIn" data-aos="fade-in">
            <form action="{{route('login.user')}}" method="POST" id="logIn">
                @csrf
                <h5>{{trans('web.login')}}</h5>

                <div class="inputs-contain">
                    <div class="userName">
                        <input type="email" id="mail" name="email" required />
                        <label for="mail">
                            <img src="{{asset('web/images/email.png')}}" alt="" /> {{trans('web.email')}} 
                        </label>
                    </div>

                    <div class="userName">
                        <input type="password" id="pass" name="password" required />
                        <label for="pass">
                            <img src="{{asset('web/images/padlock.png')}}" alt="" /> {{trans('web.password')}} 
                        </label>
                    </div>
                </div>

                <div class="forgetPass">
                    <a href="#">{{trans('web.forget_password')}}</a>
                </div>

                <div class="submit">
                    <button type="submit" class="custom-btn">{{trans('web.do_login')}}</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Register modal start --}}
    <div class="modal fade" id="login-choose" tabindex="-1" role="dialog" aria-labelledby="login-choose" aria-hidden="true">
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
        
                    @if($role->name == 'student')
                    <div class="choose-login-link">
                        <a href="{{route('register.form', $role->id)}}"> <i class="fa fa-user-graduate"></i>{{trans('web.student')}}</a>
                    </div>
                    @endif
        
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
        
                    @if($role->name == 'organization')
                    <div class="choose-login-link">
                        <a href="{{route('register.form', $role->id)}}"><i class="fa fa-school"></i>{{trans('web.organization')}}</a>
                    </div>
                    @endif
        
                    @if($role->name == 'job_seeker')
                    <div class="choose-login-link">
                        <a href="{{route('register.form', $role->id)}}"><i class="fa  fa-search"></i> {{trans('web.job_seeker')}}</a>
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