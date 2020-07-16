@extends('web.layouts.register')
@section('title', trans('web.register'))
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

    <div class="signUp" data-aos="fade-in">
      <form action="{{route('register.user', $role_id)}}" method="POST" id="signUp" enctype="multipart/form-data">
        @csrf
        <h5>{{trans('web.register')}}</h5>

        @if($role_id == 5)
        {{-- edu type start --}}
        <div class="userName custom-select2">
          <select class="custom-input" name="edu_type_id" required>
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
        @endif

        {{-- name start --}}
        <div class="inputs-contain">
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

          {{-- phone main start --}}
          <div class="userName">
            <input type="tel" id="mob" name="phone_main" value="{{old('phone_main')}}" required />
            <label for="mob">
              <i class="fa fa-mobile-alt"></i> {{trans('web.phone_main')}} 
            </label>
          </div>
          {{-- phone main end --}}

          {{-- phone secondary start --}}
          <div class="userName">
            <input type="tel" id="secondary_mob" value="{{old('phone_secondary')}}" name="phone_secondary" />
            <label for="secondary_mob">
              <i class="fa fa-mobile-alt"></i> {{trans('web.phone_secondary')}} 
            </label>
          </div>
          {{-- phone secondary end --}}

          @if($role_id != 5)
          {{-- age start --}}
          <div class="userName">
            <input type="number" name="age" value="{{old('age')}}" required />
            <label for="country">
              <i class="far fa-user"></i> {{trans('web.age')}}
            </label>
          </div>
          {{-- age end --}}
          @endif

          @if($role_id == 2)
          {{-- stages start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="stage_id">
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
            <select class="custom-input" name="edu_level_id">
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
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- materials start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="material_ids[]" multiple>
              <option value="{{null}}">{{trans('web.materials')}}</option>
              @foreach($materials as $material)
                <option value="{{$material->id}}" @if(old('level_id') == $material->id) selected @endif>{{$material->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="fa fa-book"></i>
            </span>
          </div>
          {{-- materials end --}}
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- nationalities start --}}
          <div class="userName custom-select2">
            <select class="custom-input" name="nationality_id">
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
          @endif

          @if($role_id != 2)
          {{-- countries start --}}
          <div class="userName custom-select2">
            <select class="custom-input" id="country_id" name="country_id">
              <option value="{{null}}">{{trans('web.country')}}</option>
              @foreach($countries as $country)
                <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
              @endforeach
            </select>
            <span class="form-icon">
              <i class="far fa-flag"></i>
            </span>
          </div>
          {{-- countries end --}}
          @endif

          @if($role_id != 2)
          {{-- cities start --}}
          <div class="userName custom-select2">
            <select class="custom-input" id="city_id" name="city_id">
              <option value="{{null}}">{{trans('web.city')}}</option>
            </select>
            <span class="form-icon">
              <i class="fa fa-map-marker"></i>
            </span>
          </div>
          {{-- cities end --}}
          @endif

          @if($role_id != 2)
          {{-- address start --}}
          <div class="userName">
            <input type="text" name="address" value="{{old('address')}}" required />
            <label for="country">
              <i class="far fa-map"></i> {{trans('web.address')}}
            </label>
          </div>
          {{-- address end --}}
          @endif

          @if($role_id == 3)
          {{-- teaching_address start --}}
          <div class="userName">
            <input type="number" name="teaching_address" value="{{old('teaching_address')}}" required />
            <label for="country">
              <i class="fa fa-map"></i> {{trans('web.teaching_address')}}
            </label>
          </div>
          {{-- teaching_address end --}}
          @endif

          @if($role_id == 3 || $role_id == 4)
          {{-- bio_ar start --}}
          <div class="userName">
            <textarea name="bio_ar" class="form-control" role="6" cols="30" required> {{old('bio_ar')}}</textarea>
            <label for="country">
              <i class="fa fa-address-book-o"></i> {{trans('web.bio_ar')}}
            </label>
          </div>
          {{-- bio_ar end --}}

          {{-- bio_en start --}}
          <div class="userName">
            <textarea name="bio_en" class="form-control" role="6" cols="30" required> {{old('bio_en')}}</textarea>
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
          <div class="userName">
            <input type="file" id="cv" name="cv" accept="application/pdf" required/>
            <label for="cv">
              <i class="fa fa-mobile-alt"></i> {{trans('web.cv')}} 
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
        </div>
        {{-- password confirmation end --}}

        {{-- image start --}}
        <div class="userName">
          <input type="file" id="image" name="image" accept="image/*" />
          <label for="image">
            <i class="fa fa-mobile-alt"></i> {{trans('web.image')}} 
          </label>
        </div>
        {{-- image end --}}

        <div class="submit">
          <button type="submit" class="custom-btn">{{trans('web.do_register')}}</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#country_id').change(function(){
                $.ajax({
                    url: "{{route('countries.getCities')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
                    success: function(data){
                        $('#city_id').html(data);
                    }
                });
            });
        });
    </script>
@endsection