@extends('web.layouts.register')
@section('title', trans('web.register'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')
<div class="background"></div>

  <div class="cardBody">
    <div class="goSignUp">
        <div class="logo">
            <img src="{{asset('web/images/Vector-Smart-Object2.png')}}" alt="" />
        </div>

        <div class="welcome">
            <p>
                {{$welcome_text}}
            </p>
        </div>

        <div class="login-btn">
            @if(!Auth::check())
              <a href="{{route('login.form')}}" class="white-btn">{{trans('web.login')}}</a>
            @endif
        </div>
    </div>

    <div class="signUp" data-aos="fade-in">
      <form action="{{route('register.user', $role_id)}}" method="POST" id="signUp" enctype="multipart/form-data">
        @csrf
        <h5>{{trans('web.register')}}</h5>



        {{-- name start --}}
        <div class="inputs-contain">
          
        @if($role_id == 5)
          {{-- edu type start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="edu_type_id" id="edu_type_id" required>
              <option value="{{null}}">{{trans('web.edu_type')}}</option>
              @foreach($types as $type)
                <option value="{{$type->id}}" @if(old('level_id') == $type->id) selected @endif>{{$type->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="fa fa-level-up"></i>
            </span>
          </div>
          {{-- edu type end --}}

          {{-- other_edu_type start --}}
          <div class="userName" id="other_edu_type" hidden>
            <input type="text" id="username" name="other_edu_type" value="{{old('other_edu_type')}}" />
            <label for="username" id="label">
              <i class="far fa-user"></i> {{trans('web.other_edu_type')}} 
            </label>
          </div>
          {{-- other_edu_type end --}}
        @endif

          <div class="userName">
            <input type="text" id="username" name="name" value="{{old('name')}}" required />
            <label for="username" id="label">
              <i class="far fa-user"></i> {{trans('web.user_name')}} 
            </label>
          </div>
          {{-- name end --}}

          {{-- email start --}}
          <div class="userName">
            <input type="email" id="mail" name="email" value="{{old('email')}}" required />
            <label for="mail">
              <i class="far fa-envelope"></i> {{trans('web.email')}} 
            </label>
          </div>
          {{-- email end --}}

          @if($role_id != 'visitor')
            {{-- phone main start --}}
            <div class="userName">
              <input type="tel" id="mob" name="phone_main" value="{{old('phone_main')}}" required />
              <label for="mob">
                <i class="fa fa-mobile-alt"></i> {{trans('web.phone_main')}} 
              </label>
            </div>
            {{-- phone main end --}}
          @endif

          @if($role_id != 'visitor')
            {{-- phone secondary start --}}
            <div class="userName">
              <input type="tel" id="secondary_mob" value="{{old('phone_secondary')}}" name="phone_secondary" />
              <label for="secondary_mob">
                <i class="fa fa-mobile-alt"></i> {{trans('web.phone_secondary')}} 
              </label>
            </div>
            {{-- phone secondary end --}}
          @endif

          @if($role_id != 5 && $role_id != 'visitor')
          {{-- age start --}}
          <div class="userName">
            <input type="number" id="age" name="age" value="{{old('age')}}" required />
            <label for="age">
              <i class="far fa-user"></i> {{trans('web.age')}}
            </label>
          </div>
          {{-- age end --}}
          @endif

          @if($role_id == 2)
          {{-- stages start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="stage_id" id="stage_id">
              <option value="{{null}}">{{trans('web.stage')}}</option>
              @foreach($stages as $stage)
                <option value="{{$stage->id}}" @if(old('stage_id') == $stage->id) selected @endif>{{$stage->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="fa fa-list-alt"></i>
            </span>
          </div>
          {{-- stages end --}}

          {{-- other stage start --}}
          <div class="userName" id="other_stage" hidden>
            <input type="text" name="other_stage" value="{{old('other_stage')}}" />
            <label for="country">
              <i class="far fa-building"></i> {{trans('web.other_stage')}}
            </label>
          </div>
          {{-- other stage end --}}
          @endif

          @if($role_id == 3 ||$role_id == 4 || $role_id == 6)
          {{-- exper years start --}}
          <div class="userName">
            <input type="number" name="exper_years" value="{{old('exper_years')}}" required />
            <label for="country">
              <i class="far fa-building"></i> {{trans('web.exper_years')}}
            </label>
          </div>
          {{-- exper years end --}}
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- edu level start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="edu_level_id" id="edu_level_id">
              <option value="{{null}}">{{trans('web.edu_level')}}</option>
              @foreach($levels as $level)
                <option value="{{$level->id}}" @if(old('level_id') == $level->id) selected @endif>{{$level->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="fa fa-level-up"></i>
            </span>
          </div>
          {{-- edu level end --}}

          {{-- other_edu_level start --}}
          <div class="userName" id="other_edu_level" hidden>
            <input type="text" name="other_edu_level" value="{{old('other_edu_level')}}" />
            <label for="country">
              <i class="far fa-building"></i> {{trans('web.other_edu_level')}}
            </label>
          </div>
          {{-- other_edu_level end --}}
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- materials start --}}
          <div class="userName custom-menu-select">
          <div class="title-check  text-right-dir">     
            <span class="form-icon">
              <i class="fa fa-book"></i>
            </span>
            {{trans('web.materials')}}
          </div>
          <div class="all-checks">
              @foreach($materials as $material)
                <div class="custom-check text-right-dir">
                  <input type="checkbox" name="material_ids[]" value="{{$material->id}}" id="check-{{$material->id}}" required>
                  {{-- <input type="checkbox" name="{{$material->id}}" id="check-{{$material->id}}"> --}}
                  <label for="check-{{$material->id}}"> @if(old('level_id') == $material->id) selected @endif {{$material->{'name_'.session('lang')} }}</label>
                </div>
              @endforeach
            </div>
          </div>
          {{-- materials end --}}
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- nationalities start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="nationality_id" id="nationality_id">
              <option value="{{null}}">{{trans('web.nationality')}}</option>
              @foreach($nationalities as $nation)
                <option value="{{$nation->id}}" @if(old('nationality_id') == $nation->id) selected @endif>{{$nation->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="fa fa-globe"></i>
            </span>
          </div>
          {{-- nationalities end --}}
          
          {{-- other nationality start --}}
          <div class="userName" id="other_nationality" hidden>
            <input type="text" name="other_nationality" value="{{old('other_nationality')}}" />
            <label for="country">
              <i class="far fa-building"></i> {{trans('web.other_nationality')}}
            </label>
          </div>
          {{-- other mationality end --}}
          @endif

          {{-- @if($role_id != 2 && $role_id != 'visitor') --}}
          {{-- countries start --}}
          {{-- <div class="userName custom-select2">
            <select class="custom-input" id="country_id" name="country_id">
              <option value="{{null}}">{{trans('web.country')}}</option>
              @foreach($countries as $country)
                <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="far fa-flag"></i>
            </span>
          </div> --}}
          {{-- countries end --}}
          {{-- @endif --}}

          {{-- @if($role_id != 2 && $role_id != 'visitor') --}}
          {{-- cities start --}}
          {{-- <div class="userName custom-select2">
            <select class="custom-input" id="city_id" name="city_id">
              <option value="{{null}}">{{trans('web.city')}}</option>
            </select>
            <span class="form-icon">
              <i class="fa fa-map-marker"></i>
            </span>
          </div> --}}
          {{-- cities end --}}
          {{-- @endif --}}

          @if($role_id != 2 && $role_id != 'visitor')
          {{-- address start --}}
          {{-- <div class="userName">
            <input type="text" name="address" value="{{old('address')}}" required />
            <label for="country">
              <i class="far fa-map"></i> {{trans('web.address')}}
            </label>
          </div> --}}
          {{-- address end --}}
          @endif

          {{-- @if($role_id == 3) --}}
          {{-- teaching_address start --}}
          {{-- <div class="userName">
            <input type="number" name="teaching_address" value="{{old('teaching_address')}}" required />
            <label for="country">
              <i class="fa fa-map"></i> {{trans('web.teaching_address')}}
            </label>
          </div> --}}
          {{-- teaching_address end --}}
          {{-- @endif --}}

          @if($role_id == 4)
          {{-- teaching_method start --}}
          <div class="userName">
            <input type="text" name="teaching_method" value="{{old('teaching_method')}}" required />
            <label for="country">
              <i class="far fa-map"></i> {{trans('web.teaching_method')}}
            </label>
          </div>
          {{-- teaching_method end --}}
          @endif

        {{-- image start --}}
          <div class="userName custom-file">
            <input type="file" id="image" name="image"  accept=".gif, .jpg, .png, .webp" />
            <label for="image">
              <i class="fa fa-file"></i> <span>{{trans('web.image')}}</span> 
            </label>
          </div>
        {{-- image end --}}

          @if($role_id == 3 || $role_id == 4)
          {{-- bio_ar start --}}
          <div class="userName">
            <textarea name="bio_ar" class="form-control" rows="6" cols="30" required> {{old('bio_ar')}}</textarea>
            <label for="country">
              <i class="fa fa-address-book-o"></i> {{trans('web.bio_ar')}}
            </label>
          </div>
          {{-- bio_ar end --}}

          {{-- bio_en start --}}
          <div class="userName">
            <textarea name="bio_en" class="form-control" rows="6" cols="30" required> {{old('bio_en')}}</textarea>
            <label for="country">
              <i class="fa fa-address-book-o"></i> {{trans('web.bio_en')}}
            </label>
          </div>
          {{-- bio_en end --}}
          @endif

          @if($role_id == 6)
          {{-- salary start --}}
          <div class="userName">
            <input type="number" name="salary_month" value="{{old('salary')}}" required />
            <label for="country">
              <i class="far fa-building"></i> {{trans('web.salary')}}
            </label>
          </div>
          {{-- salary end --}}

          {{-- cv start --}}
          <div class="userName custom-file">
            <input type="file" id="cv" name="cv" accept="application/pdf" required/>
            <label for="cv">
              <i class="fa fa-file"></i> <span>{{trans('web.cv')}} </span>
            </label>
          </div>
        {{-- cv end --}}
          @endif
          
          {{-- password start --}}
          <div class="userName">
            <input type="password" name="password" value="{{old('password')}}" id="pass" required />
            <label for="pass">
              <i class="fa fa-lock"></i> {{trans('web.password')}} 
            </label>
          </div>
          {{-- password end --}}

          {{-- password confirmation start --}}
          <div class="userName">
            <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" id="confirm" required />
            <label for="confirm">
              <i class="fa fa-lock"></i> {{trans('web.password_confirmation')}}  
            </label>
          </div>

        {{-- password confirmation end --}}
        
        {{-- address start --}}
        @if($role_id != 2 && $role_id != 'visitor')
          {{-- map start --}}
            <div class="userName">
           <div class="text-right-dir map-label">{{trans('web.address')}}</div>
            {{-- address --}}
             
              <input id="pac-input" name="address" class="controls form-control" type="text" placeholder="{{trans('web.address')}}" value="">
              <input type="hidden" name="lat" value="" id="location_lat">
              <input type="hidden" name="long" value="" id="location_lng"> 
            </div>


            <div class="userName">
              {{-- teaching address --}}
              @if($role_id == 3)
              <div class="text-right-dir map-label">{{trans('web.teaching_address')}}</div>
                <input name="teaching_address" class="controls form-control" type="text" placeholder="{{trans('web.teaching_address')}}" value="">
                <input type="hidden" name="lat2" value="" id="location_lat2">
                <input type="hidden" name="long2" value="" id="location_lng2">
              @endif

            </div>
            
            <div class="map-div">
              <div id="gmap" style="width:100%;height:400px;">
            </div>
          {{-- map end --}}
        @endif
        {{-- address end --}}
        
        <div class="submit">
          <button type="submit" class="custom-btn">{{trans('web.do_register')}}</button>
        </div>
    </div>
      </form>
    </div>
  </div>
  
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

          // Get cities of selected country
            // $('#country_id').change(function(){
            //     $.ajax({
            //         url: "{{route('countries.getCities')}}",
            //         type: "POST",
            //         dataType: 'html',
            //         data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
            //         success: function(data){
            //             $('#city_id').html(data);
            //         }
            //     });
            // });

            // Show other_stage input when user selects other option stage_id
              $(document).on('change', '#stage_id', function(){
                if($(this).val() == 4){
                  $('#other_stage').attr('hidden', false);
                  $('#other_stage').attr('required', true);
                }
                else{
                  $('#other_stage').attr('hidden', true);                
                  $('#other_stage').attr('required', false);
                  $("input[name*='other_stage']").val('');
                }
              });

              // Show other_nationality input when user selects other option nationality_id
              $(document).on('change', '#nationality_id', function(){
                if($(this).val() == 3){
                  $('#other_nationality').attr('hidden', false);
                  $('#other_nationality').attr('required', true);
                }
                else{
                  $('#other_nationality').attr('hidden', true); 
                  $('#other_nationality').attr('required', false);               
                  $("input[name*='other_nationality']").val('');
                }
              });

              // Show other_edu_level input when user selects other option edu_level_id
              $(document).on('change', '#edu_level_id', function(){
                if($(this).val() == 4){
                  $('#other_edu_level').attr('hidden', false);
                  $('#other_edu_level').attr('required', true);
                }
                else{
                  $('#other_edu_level').attr('hidden', true);  
                  $('#other_edu_level').attr('required', false);              
                  $("input[name*='other_edu_level']").val('');
                }
              });

              // Show other_edu_type input when user selects other option edu_type_id
              $(document).on('change', '#edu_type_id', function(){
                if($(this).val() == 4){
                  $('#other_edu_type').attr('hidden', false);
                  $('#other_edu_type').attr('required', true);
                }
                else{
                  $('#other_edu_type').attr('hidden', true);                
                  $('#other_edu_type').attr('required', false);
                  $("input[name*='other_edu_type']").val('');
                }
              });

            $(".custom-file input").on("change", function() {
              var fileName = $(this).val().split("\\").pop();
              $(this).next("label").find("span").html(fileName);
            });

            $(".inputs-contain input").focusout(function(){
              if ($(this).val() != ""){
                  $(this).addClass("active")
              }
              else{
                  $(this).removeClass("active")
              }
            });

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
              ) {
                    $(".all-checks").slideUp();


              }
          });
        });
    </script>
@endsection