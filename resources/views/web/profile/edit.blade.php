@extends('web.layouts.app')
@section('title', trans('web.edit_personal_info'))
@section('description', 'waseet description')
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
                                                <input type="file" id="imageUpload" name="image" value="" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"></label>
                                            </div>

                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url({{auth()->user()->image ? auth()->user()->image->path : 'web/images/user2.png'}})">
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
                                    {{-- edu type end --}}
                                @endif

                                {{-- name start --}}
                                <div class="big-label">{{trans('web.full_name')}} :</div>
                                <div class="userName">
                                    <input type="text" name="name" value="{{Auth::user()->name}}" id="username" placeholder="جدارة" required />
                                </div>
                                {{-- name end --}}

                                {{-- email start --}}
                                <div class="big-label">{{trans('web.email')}} :</div>
                                <div class="userName">
                                    <input type="email" name="email" value="{{Auth::user()->email}}" id="mail" placeholder="sales@jaadara.com" required/>
                                </div>
                                {{-- email end --}}

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('student') || Auth::user()->hasRole('direct_teacher') ||
                                    Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
                                    {{-- phone main start --}}
                                    <div class="big-label">{{trans('web.phone_main')}} :</div>
                                    <div class="userName">
                                        <input type="tel" id="mob" name="phone_main" value="{{Auth::user()->phone_main}}" placeholder="+966563793461" required/>
                                    </div>
                                    {{-- phone main end --}}

                                    {{-- phone secondary start --}}
                                    <div class="big-label">{{trans('web.phone_secondary')}} :</div>
                                    <div class="userName">
                                        <input type="tel" id="mob" name="phone_secondary" name="{{Auth::user()->phone_secondary}}" placeholder="+966563793461" />
                                    </div>
                                    {{-- phone secondary end --}}
                                @endif

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('student') || Auth::user()->hasRole('direct_teacher') ||
                                    Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('job_seeker'))
                                    {{-- age start --}}
                                    <div class="big-label">{{trans('web.age')}} :</div>
                                    <div class="userName">
                                        <input type="number" name="age" id="country" value="{{Auth::user()->age}}" placeholder="32" required/>
                                    </div>
                                    {{-- age end --}}
                                @endif

                                @if(Auth::user()->hasRole('student'))
                                    {{-- stage start --}}
                                    <div class="big-label">{{trans('web.stage')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="stage_id" required>
                                            <option value="{{null}}">{{trans('web.stage')}}</option>
                                            @foreach($stages as $stage)
                                            <option value="{{$stage->id}}" @if(Auth::user()->stage_id == $stage->id) selected @endif>{{$stage->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- stage end --}}
                                @endif

                                @if(Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('job_seeker'))
                                    {{-- exper years start --}}
                                    <div class="big-label">{{trans('web.exper_years')}} :</div>
                                    <div class="userName">
                                        <input type="number" name="exper_years" id="country" value="{{Auth::user()->exper_years}}" placeholder="5" required/>
                                    </div>
                                    {{-- exper years end --}}
                                @endif

                                @if(Auth::user()->hasRole('online_teacher') || Auth::user()->hasRole('direct_teacher'))
                                    {{-- edu level start --}}
                                    <div class="big-label">{{trans('web.edu_level')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="edu_level_id" required>
                                            <option value="{{null}}">{{trans('web.edu_level')}}</option>
                                            @foreach($levels as $level)
                                            <option value="{{$level->id}}" @if(Auth::user()->edu_level_id == $level->id) selected @endif>{{$level->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- edu level end --}}

                                    {{-- materials start --}}
                                    <div class="big-label">{{trans('web.materials')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="material_ids[]" multiple required>
                                            <option value="{{null}}">{{trans('web.materials')}}</option>
                                            @foreach($materials as $material)
                                                <option value="{{$material->id}}" @if(Auth::user()->materials->contains($material->id)) selected @endif>{{$material->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- materials end --}}

                                    {{-- nationality start --}}
                                    <div class="big-label">{{trans('web.nationality')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" name="nationality_id" required>
                                            <option value="{{null}}">{{trans('web.nationality')}}</option>
                                            @foreach($nationalities as $nation)
                                            <option value="{{$nation->id}}" @if(Auth::user()->nationality_id == $nation->id) selected @endif>{{$nation->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- nationality end --}}
                                @endif

                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher') ||
                                    Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
                                    {{-- country start --}}
                                    <div class="big-label">{{trans('web.country')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" id="country_id" name="country_id" required>
                                            <option value="{{null}}">{{trans('web.country')}}</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if(Auth::user()->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- country end --}}

                                    {{-- city start --}}
                                    <div class="big-label">{{trans('web.city')}} :</div>
                                    <div class="userName">
                                        <select class="custom-input" id="city_id" name="city_id" required>
                                            <option value="{{null}}">{{trans('web.city')}}</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" @if(Auth::user()->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- city end --}}

                                    {{-- address start --}}
                                    <div class="big-label">{{trans('web.address')}} :</div>
                                    <div class="userName">
                                        <input type="text" name="address" value="{{Auth::user()->address}}" id="confirm" placeholder="الرياض ,المملكة العربية السعودية" required/>
                                    </div>
                                    {{-- address end --}}
                                @endif

                                @if(Auth::user()->hasRole('direct_teacher'))
                                    {{-- teaching address start --}}
                                    <div class="big-label">{{trans('web.teaching_address')}} :</div>
                                    <div class="userName">
                                        <input type="text" name="teaching_address" value="{{Auth::user()->teaching_address}}" id="confirm" placeholder="الرياض ,المملكة العربية السعودية" required/>
                                    </div>
                                    {{-- teaching address end --}}
                                @endif

                                @if(Auth::user()->hasRole('job_seeker'))
                                    {{-- salary start --}}
                                    <div class="big-label">{{trans('web.salary')}} :</div>
                                    <div class="userName">
                                        <input type="number" name="salary_month" value="{{Auth::user()->salary_month}}" id="confirm" placeholder="4000.00" required/>
                                    </div>
                                    {{-- salary end --}}
                                @endif

                                @if(Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher'))
                                    {{-- bio_ar start --}}
                                    <div class="big-label">{{trans('web.bio_ar')}} :</div>
                                    <div class="userName">
                                        <textarea name="bio_ar" class="form-control" rows="6" cols="30" required> {{Auth::user()->bio_ar}}</textarea>
                                    </div>
                                    {{-- bio_ar end --}}

                                    {{-- bio_en start --}}
                                    <div class="big-label">{{trans('web.bio_en')}} :</div>
                                    <div class="userName">
                                        <textarea name="bio_en" class="form-control" rows="6" cols="30" required> {{Auth::user()->bio_en}}</textarea>
                                    </div>
                                    {{-- bio_en end --}}
                                @endif

                                @if(Auth::user()->hasRole('job_seeker'))
                                    {{-- cv start --}}
                                    <div class="big-label">{{trans('web.cv')}} : </div>
                                    <div class="userName custom-file">
                                        <input type="file" id="file-up" accept="application/pdf" name="cv" required/>
                                        <label for="file-up">
                                            <i class="fa fa-upload"></i> <span></span>
                                        </label>
                                    </div>

                                    @if(auth()->user()->document != null)
                                        <div class="userName custom-file">
                                            <a href="{{auth()->user()->document->path}}">{{trans('web.view_cv')}}</a>
                                        </div>
                                    @endif
                                    {{-- cv end --}}
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