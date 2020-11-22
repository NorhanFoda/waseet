@extends('web.layouts.app')
@section('title', trans('web.edit_personal_info'))
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

    <h5 class="second_title second_color text-center margin-div">{{trans('web.profile')}}</h5>

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="{{route('profile.store_personal_info')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="inputs-contain">
                                <div class="col-12">
                                    <div class="profile-img">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type="file" class="active" id="imageUpload" name="image" value="" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"></label>
                                            </div>

                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('{{auth()->user()->image ? auth()->user()->image->path : asset("web/images/user2.png") }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->hasRole('organization'))
                                    {{-- edu type start --}}
                                    <div class="big-label">{{trans('web.edu_type')}}</div>
                                    <div class="userName">
                                        <select class="custom-input" id="edu_type_id" name="edu_type_id" required>
                                            <option value="{{null}}">{{trans('web.edu_type')}}</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" @if(Auth::user()->edu_type_id == $type->id) selected @endif>{{$type->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if(Auth::user()->edu_type_id == 4 && Auth::user()->other_edu_type != null)
                                        <div class="big-label other_edu_type">{{trans('web.other_edu_type')}} :</div>
                                        <div class="userName other_edu_type">
                                            <input type="text" class="active" name="other_edu_type" id="country" placeholder="{{trans('web.other_edu_type')}}" value="{{Auth::user()->other_edu_type}}" >
                                        </div>
                                    @endif
                                    {{-- edu type end --}}
                                @endif

                                {{-- name start --}}
                                <div class="big-label">{{trans('web.full_name')}} :</div>
                                <div class="userName">
                                    <input type="text" name="name" class="active" value="{{Auth::user()->name}}" id="username" placeholder="جدارة" required />
                                </div>
                                {{-- name end --}}

                                {{-- email start --}}
                                <div class="big-label">{{trans('web.email')}} :</div>
                                <div class="userName">
                                    <input type="email" name="email" class="active" value="{{Auth::user()->email}}" id="mail" placeholder="sales@jaadara.com" required/>
                                </div>
                                {{-- email end --}}

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('student') || Auth::user()->hasRole('direct_teacher') ||
                                    Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
                                    @php
                                        if(strpos(Auth::user()->phone_main, ',') !== false){
                                            $arr = explode(',' , Auth::user()->phone_main);
                                            $key = $arr[0];
                                            $phone_main = $arr[1];
                                        }
                                        else{
                                            $key = '';
                                            $phone_main = Auth::user()->$phone_main;
                                        }
                                        
                                        $phone_secondary = null;
                                        $sec_key = null;
                                        if(Auth::user()->phone_secondary != null && strpos(Auth::user()->phone_secondary, ',') !== false){
                                            $arr2 = explode(',' , Auth::user()->phone_secondary);
                                            $sec_key = $arr2[0];
                                            $phone_secondary = $arr2[1];
                                        }
                                        else{
                                            $sec_key = '';
                                            $phone_secondary = Auth::user()->$phone_secondary;
                                        }
                                        
                                    @endphp
                                    {{-- phone main start --}}
                                    <div class="big-label">{{trans('web.phone_main')}} :</div>
                                    <div class="userName">
                                        <input type="hidden" id="mob" value="{{$key}} {{$phone_main}}" />
                                        <input type="hidden"  class="hidden-in" name="full"/>
                                        <input type="tel" class="active phone-input-style" name="phone_main" value="{{$phone_main}}" minlength="9" maxlength="11" placeholder="+966563793461" required/>
                                    </div>
                                    {{-- phone main end --}}

                                    {{-- phone secondary start --}}
                                    <div class="big-label">{{trans('web.phone_secondary')}} :</div>
                                    <div class="userName">
                                        <input type="hidden" id="sec_mob" value="{{$sec_key}} {{$phone_secondary}}" />
                                        <input type="hidden"  class="sec_hidden-in" name="sec_full"/>
                                        <input type="tel" class="active phone-input-style" name="phone_secondary" value="{{$phone_secondary}}" minlength="9" maxlength="11" placeholder="+966563793461" />
                                    </div>
                                    {{-- phone secondary end --}}
                                @endif

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('student') || Auth::user()->hasRole('direct_teacher') ||
                                    Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('job_seeker'))
                                    {{-- age start --}}
                                    <div class="big-label">{{trans('web.age')}} :</div>
                                    <div class="userName">
                                        <input type="number" class="active" name="age" id="country" value="{{Auth::user()->age}}" placeholder="32" required/>
                                    </div>
                                    {{-- age end --}}
                                @endif

                                @if(Auth::user()->hasRole('student'))
                                    {{-- stage start --}}
                                    <div class="big-label">{{trans('web.stage')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" id="stage_id" name="stage_id" required>
                                            <option value="{{null}}">{{trans('web.stage')}}</option>
                                            @foreach($stages as $stage)
                                            <option value="{{$stage->id}}" @if(Auth::user()->stage_id == $stage->id) selected @endif>{{$stage->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if(Auth::user()->stage_id == 4 && Auth::user()->other_stage != null)
                                        <div class="big-label other_stage">{{trans('web.other_stage')}} :</div>
                                        <div class="userName other_stage">
                                            <input type="text" class="active" name="other_stage" id="country" placeholder="{{trans('web.other_stage')}}" value="{{Auth::user()->other_stage}}" >
                                        </div>
                                    @endif
                                    {{-- stage end --}}
                                @endif

                                @if(Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('job_seeker'))
                                    {{-- exper years start --}}
                                    <div class="big-label">{{trans('web.exper_years')}} :</div>
                                    <div class="userName">
                                        <input type="number" class="active" name="exper_years" id="country" value="{{Auth::user()->exper_years}}" placeholder="5" required/>
                                    </div>
                                    {{-- exper years end --}}
                                @endif

                                @if(Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('direct_teacher'))
                                    {{-- edu level start --}}
                                    <div class="big-label">{{trans('web.edu_level')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="edu_level_id" id="edu_level_id" required>
                                            <option value="{{null}}">{{trans('web.edu_level')}}</option>
                                            @foreach($levels as $level)
                                            <option value="{{$level->id}}" @if(Auth::user()->edu_level_id == $level->id) selected @endif>{{$level->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if(Auth::user()->edu_level_id == 4 && Auth::user()->other_edu_level != null)
                                        <div class="big-label other_edu_level">{{trans('web.other_edu_level')}} :</div>
                                        <div class="userName other_edu_level">
                                            <input type="text" class="active" name="other_edu_level" id="country" placeholder="{{trans('web.other_edu_type')}}" value="{{Auth::user()->other_edu_level}}" >
                                        </div>
                                    @endif
                                    {{-- edu level end --}}

                                    {{-- teaching_method start --}}
                                    @if(Auth::user()->hasRole('online_teacher'))
                                        <div class="big-label">{{trans('web.teaching_method')}} :</div>
                                        <div class="userName">
                                            <input type="text" class="active" name="teaching_method" id="country" placeholder="{{trans('web.teaching_method')}}" value="{{Auth::user()->teaching_method}}" required>
                                        </div>
                                    @endif
                                    {{-- teaching_method end --}}

                                    {{-- materials start --}}
                                    <div class="big-label"> {{trans('web.materials')}} :</div>
                                    <div class="userName custom-menu-select">
                                        <div class="title-check  text-right-dir">     
                                        <span class="form-icon">
                                            <i class="fa fa-book"></i>
                                        </span>
                                        {{trans('web.materials')}}
                                        </div>
                                        <div class="all-checks">
                                            <select name="material_ids[]" class="custom-input" required id="material_id" multiple>
                                                <option value="{{null}}">{{trans('web.materials')}}</option>
                                                @foreach($materials as $material)
                                                <option value="{{$material->id}}" @if(Auth::user()->materials->contains($material->id)) selected @endif>{{$material->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- other_material start --}}
                                    <div class="big-label other_material" @if(!Auth::user()->materials->contains(4)) hidden @endif>{{trans('admin.other_material')}} :</div>
                                    <div class="userName other_material" @if(!Auth::user()->materials->contains(4)) hidden @endif>
                                        <input type="text" class="active" name="other_material" value="
                                            @if(Auth::user()->materials()->where('material_id', 4)->first() != null)
                                                {{Auth::user()->materials()->where('material_id', 4)->first()->pivot->other_material}}
                                            @endif" />
                                        <label for="country">
                                            <i class="far fa-building"></i> {{trans('admin.other_material')}}
                                        </label>
                                    </div>
                                    {{-- other_material end --}}

                                    {{-- nationality start --}}
                                    <div class="big-label">{{trans('web.nationality')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="nationality_id" id="nationality_id" required>
                                            <option value="{{null}}">{{trans('web.nationality')}}</option>
                                            @foreach($nationalities as $nation)
                                            <option value="{{$nation->id}}" @if(Auth::user()->nationality_id == $nation->id) selected @endif>{{$nation->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if(Auth::user()->nationality_id == 3 && Auth::user()->other_nationality != null)
                                        <div class="big-label other_nationality">{{trans('web.other_nationality')}} :</div>
                                        <div class="userName other_nationality">
                                            <input type="text" class="active" name="other_nationality" id="country" placeholder="{{trans('web.other_nationality')}}" value="{{Auth::user()->other_nationality}}" >
                                        </div>
                                    @endif
                                    {{-- nationality end --}}
                                @endif

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher') ||
                                    Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
                                    {{-- country start --}}
                                    {{-- <div class="big-label">{{trans('web.country')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" id="country_id" name="country_id" required>
                                            <option value="{{null}}">{{trans('web.country')}}</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if(Auth::user()->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- country end --}}

                                    {{-- city start --}}
                                    {{-- <div class="big-label">{{trans('web.city')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" id="city_id" name="city_id" required>
                                            <option value="{{null}}">{{trans('web.city')}}</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" @if(Auth::user()->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- city end --}}
                                @endif

                                @if(Auth::user()->hasRole('job_seeker'))
                                    {{-- salary start --}}
                                    <div class="big-label">{{trans('web.salary')}} :</div>
                                    <div class="userName">
                                        <input type="number" class="active" name="salary_month" value="{{Auth::user()->salary_month}}" id="confirm" placeholder="4000.00" required/>
                                    </div>
                                    {{-- salary end --}}
                                @endif

                                @if(Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher'))
                                    {{-- bio_ar start --}}
                                    <div class="big-label">{{trans('web.bio_ar')}} :</div>
                                    <div class="userName">
                                        <textarea name="bio_ar" class="form-control active" rows="6" cols="30" required> {{Auth::user()->bio_ar}}</textarea>
                                    </div>
                                    {{-- bio_ar end --}}

                                    {{-- bio_en start --}}
                                    <div class="big-label">{{trans('web.bio_en')}} :</div>
                                    <div class="userName">
                                        <textarea name="bio_en" class="form-control active" rows="6" cols="30" required> {{Auth::user()->bio_en}}</textarea>
                                    </div>
                                    {{-- bio_en end --}}
                                @endif

                                @if(Auth::user()->hasRole('job_seeker'))
                                    {{-- cv start --}}
                                    <div class="big-label">{{trans('web.cv')}} : </div>
                                    <div class="userName custom-file">
                                        <input type="file" class="active" id="file-up" accept="application/pdf" name="cv"/>
                                        <label for="file-up">
                                            <i class="fa fa-upload"></i> <span></span>
                                        </label>
                                        
                                    </div>
                                    <div class="col-12">
                                        @if(auth()->user()->document != null)
                                            <div class="userName custom-file">
                                                <a href="{{auth()->user()->document->path}}" class="first_color">{{trans('web.view_cv')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                  
                                    {{-- cv end --}}
                                @endif

                                @if(Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher') ||
                                    Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))

                                    {{-- address start --}}
                                    {{-- <div class="big-label">{{trans('web.address')}} :</div> --}}
                                    <div class="userName">
                                        <input type="text" id="pac-input"  class="form-control active" name="address" value="{{Auth::user()->address}}" id="confirm" placeholder="الرياض ,المملكة العربية السعودية" required/>
                                        <input type="hidden" name="lat" value="{{Auth::user()->lat}}" id="location_lat">
                                        <input type="hidden" name="long" value="{{Auth::user()->long}}" id="location_lng"> 
                                    </div>
                                    {{-- address end --}}

                                @endif

                                @if(Auth::user()->hasRole('direct_teacher'))
                                    {{-- teaching address start --}}
                                    {{-- <div class="big-label">{{trans('web.teaching_address')}} :</div> --}}
                                    <div class="userName">
                                        <input type="text" id="teaching-pac-input"  class="form-control active" name="teaching_address" value="{{Auth::user()->teaching_address}}" id="confirm" placeholder="الرياض ,المملكة العربية السعودية" required/>
                                        <input type="hidden" name="lat2" value="{{Auth::user()->teaching_lat}}" id="location_lat2">
                                        <input type="hidden" name="long2" value="{{Auth::user()->teaching_long}}" id="location_lng2">
                                    </div>
                                    {{-- teaching address end --}}
                                @endif

                                @if(Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher') ||
                                    Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
                                    <div class="map-div">
                                        <div id="gmap" style="width:100%;height:400px;">
                                    </div>
                                @endif

                            </div>

                            <div class="submit col-12 text-center margin-div">
                                <button type="submit" class="custom-btn">{{trans('web.save')}}</button>
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
        // get cities of selected country
        $(document).ready(function(){
        //     $('#country_id').change(function(){
        //         $.ajax({
        //             url: "{{route('countries.getCities')}}",
        //             type: "POST",
        //             dataType: 'html',
        //             data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
        //             success: function(data){
        //                 $('#city_id').html(data);
        //             }
        //         });
        //     });
        // });

        // Show other_stage input when user selects other option stage_id
        $(document).on('change', '#stage_id', function(){
            if($(this).val() == 4){
                $('.other_stage').attr('hidden', false);
                $('.other_stage').attr('required', true);
                $("input[name*='other_stage']").val('{{Auth::user()->other_stage}}');
            }
            else{
                $('.other_stage').attr('hidden', true);                
                $('.other_stage').attr('required', false);
                $("input[name*='other_stage']").val('');
            }
        });

        // Show other_nationality input when user selects other option nationality_id
        $(document).on('change', '#nationality_id', function(){
            if($(this).val() == 3){
                $('.other_nationality').attr('hidden', false);
                $('.other_nationality').attr('required', true);
                $("input[name*='other_nationality']").val('{{Auth::user()->other_nationality}}');
            }
            else{
                $('.other_nationality').attr('hidden', true); 
                $('.other_nationality').attr('required', false);               
                $("input[name*='other_nationality']").val('');
            }
        });

        // Show other_edu_level input when user selects other option edu_level_id
        $(document).on('change', '#edu_level_id', function(){
            if($(this).val() == 4){
                $('.other_edu_level').attr('hidden', false);
                $('.other_edu_level').attr('required', true);
                $("input[name*='other_edu_level']").val('{{Auth::user()->other_edu_level}}');
            }
            else{
                $('.other_edu_level').attr('hidden', true);  
                $('.other_edu_level').attr('required', false);              
                $("input[name*='other_edu_level']").val('');
            }
        });

        // Show other_edu_type input when user selects other option edu_type_id
        $(document).on('change', '#edu_type_id', function(){
            if($(this).val() == 4){
                $('.other_edu_type').attr('hidden', false);
                $('.other_edu_type').attr('required', true);
                $("input[name*='other_edu_type']").val('{{Auth::user()->other_edu_type}}');
            }
            else{
                $('.other_edu_type').attr('hidden', true);                
                $('.other_edu_type').attr('required', false);
                $("input[name*='other_edu_type']").val('');
            }
        });

        $(document).on('change', '#material_id', function(){
            var ids = $(this).val();
            if(ids.indexOf('4') != -1){
                $('.other_material').attr('hidden', false);
                $("input[name*='other_material']").attr('required', true);
                $("input[name*='other_material']").val('{{Auth::user()->materials()->where('material_id', 4)->first() == null ? : Auth::user()->materials()->where('material_id', 4)->first()->pivot->other_material}}');
            }
            else{
                $('.other_material').attr('hidden', true);                
                $("input[name*='other_material']").attr('required', false);
                $("input[name*='other_material']").val('');
            }
        });

        
            $(".title-check").click(function(){
                $(".all-checks").slideToggle().css("overflow","auto");
            })
            
            $(function() {
                var $wina = $(window); // or $box parent container
                var $boxa = $(".custom-menu-select");
                $wina.on("click.Bst", function(event) {
                    if (
                        $boxa.has(event.target).length === 0 && //checks if descendants of $box was clicked
                        !$boxa.is(event.target) //checks if the $box itself was clicked
                    ){
                        $(".all-checks").slideUp();
                    }
                });
            });
        });

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