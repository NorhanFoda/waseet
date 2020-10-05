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
                                        $key = $arr[0];
                                        $phone_main = $arr[1];
                                    }
                                    else{
                                        $key = '';
                                        $phone_main = $user->$phone_main;
                                    }
                                    
                                    $phone_secondary = null;
                                    $sec_key = null;
                                    if($user->phone_secondary != null && strpos($user->phone_secondary, ',') !== false){
                                        $arr2 = explode(',' , $user->phone_secondary);
                                        $sec_key = $arr2[0];
                                        $phone_secondary = $arr2[1];
                                    }
                                    else{
                                        $sec_key = '';
                                        $phone_secondary = $user->$phone_secondary;
                                    }
                                @endphp

                                <div class="big-label">{{trans('web.phone_main')}}</div>
                                <div class="userName">
                                    <input type="hidden" id="mob" value="{{$key}} {{$phone_main}}" />
                                    <input type="hidden"  class="hidden-in" name="full"/>
                                    <input type="tel" class="phone-input-style" minlength="9" maxlength="11" placeholder="{{$phone_main}}" disabled />
                                </div>

                                @if($phone_secondary != null)
                                    <div class="big-label">{{trans('web.phone_secondary')}}</div>
                                    <div class="userName">
                                        <input type="hidden" id="sec_mob" value="{{$sec_key}} {{$phone_secondary}}" />
                                        <input type="hidden"  class="sec_hidden-in" name="sec_full"/>
                                        <input type="tel" class="phone-input-style" minlength="9" maxlength="11"placeholder="{{$phone_secondary}}" disabled />
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

@section('scripts')
    <script>
            /**
       * 
       * Handling country key for phones input according to stupids opinion
       * **/
      $(".no-val-input").val('');
      $(".iti__selected-dial-code").val();

      var phone_number = window.intlTelInput(document.querySelector("#mob"), {
        separateDialCode: true,
        preferredCountries: ["sa", "kw", "om", "bh", "jo", "iq", "ae", "eg"],
        hiddenInput: "full",
        utilsScript: "{{asset('web/js/vendor/utils.js')}}"
      });
      
      var sec_phone_number = window.intlTelInput(document.querySelector("#sec_mob"), {
        separateDialCode: true,
        preferredCountries: ["sa", "kw", "om", "bh", "jo", "iq", "ae", "eg"],
        hiddenInput: "sec_full",
        utilsScript: "{{asset('web/js/vendor/utils.js')}}"
      });


      $("form").submit(function() {
          var phone_val = $(".iti__selected-dial-code:eq(0)").text();
          var sec_phone_val = $(".iti__selected-dial-code:eq(1)").text();
          $(".phone-input-style").prev(".hidden-in").val(phone_val);
          $(".phone-input-style").prev(".sec_hidden-in").val(sec_phone_val);
      });
    </script>
@endsection