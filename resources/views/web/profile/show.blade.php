@extends('web.layouts.app')
@section('title', trans('web.cv'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.profile')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.profile_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <h5 class="second_title second_color text-center margin-div">{{trans('web.cv')}}</h5>

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="">
                            <div class="inputs-contain">
                                <div class="col-12">
                                    <div class="profile-img">
                                        <div class="avatar-upload">
                                            <form method="post" action="" id="upload-image">
                                                <div class="avatar-edit">
                                                    <input type="file" id="imageUpload" name="image" value=""
                                                        accept=".png, .jpg, .jpeg" disabled>
                                                    <label for="imageUpload"></label>
                                                </div>

                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url({{$user->image == null ? '/images/avatar.png' : $user->image->path}})">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <div class="big-label">{{trans('web.full_name')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" placeholder="{{$user->name}}" disabled />

                                </div>

                                <div class="big-label">{{trans('web.email')}}</div>
                                <div class="userName">
                                    <input type="email" id="mail" placeholder="{{$user->email}}" disabled />

                                </div>
                                @php
                                    if(strpos($user->phone_main, ',') !== false){
                                        $arr = explode(',' , $user->phone_main);
                                        $phone_main = $arr[1];
                                    }
                                    else{
                                        $phone_main = $user->phone_main;
                                    }
                                    if(strpos($user->phone_secondary, ',') !== false){
                                        $arr2 = explode(',' , $user->phone_secondary);
                                        $phone_secondary = $arr2[1];
                                    }
                                    else{
                                        $phone_secondary = $user->phone_main;
                                    }
                                @endphp
                                <div class="big-label">{{trans('web.phone_main')}}</div>
                                <div class="userName">
                                    <input type="tel" id="mob" placeholder="{{$phone_main}}" disabled />
                                </div>

                                @if($phone_secondary != null)
                                    <div class="big-label">{{trans('web.phone_secondary')}}</div>
                                    <div class="userName">
                                        <input type="tel" id="mob" placeholder="{{$phone_secondary}}" disabled />
                                    </div>
                                @endif

                                <div class="big-label">{{trans('web.age')}}:</div>
                                <div class="userName">
                                    <input type="number" id="country" placeholder="{{$user->age}}" disabled />

                                </div>

                                <div class="big-label">{{trans('web.exper_years')}}:</div>
                                <div class="userName">
                                    <input type="number" id="country" placeholder="{{$user->exper_years}}" disabled />

                                </div>

                                {{-- <div class="big-label">{{trans('web.country')}} : </div>
                                <div class="userName">
                                    <input type="text"  placeholder="{{$user->country->{'name_'.session('lang')} }}" disabled />                               
                                </div> --}}

                                {{-- <div class="big-label">{{trans('web.city')}} : </div>
                                <div class="userName">
                                    <input type="text"  placeholder="{{$user->city->{'name_'.session('lang')} }}" disabled />                               
                                </div> --}}

                                <div class="big-label">{{trans('web.address')}} :</div>
                                <div class="userName" disabled>
                                    <input type="text" id="confirm" placeholder="{{$user->address}}" disabled />
                                </div>

                                <div class="big-label">{{trans('web.salary')}} :</div>
                                <div class="userName" disabled>
                                    <input type="text" id="confirm" placeholder="{{$user->salary_month}}" disabled />
                                </div>

                                <div class="big-label">{{trans('web.cv')}} :</div>
                                <div class="userName" disabled>
                                    <a href="{{$user->document->path}}">{{trans('web.cv')}}</a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection