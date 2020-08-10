@extends('web.layouts.app')
@section('title', trans('web.profile'))
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

    <h5 class="second_title second_color text-center margin-div">{{trans('web.add_job')}}</h5>

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="{{route('jobs.store_job')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="inputs-contain">

                                <div class="big-label">{{trans('admin.name_ar')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" name="name_ar" required placeholder="{{trans('admin.name_ar')}}" />

                                </div>

                                <div class="big-label">{{trans('admin.name_en')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" name="name_en" required placeholder="{{trans('admin.name_en')}}" />

                                </div>

                                <div class="big-label">{{trans('admin.specialization')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" required name="specialization_id">
                                        <option value="{{null}}">{{trans('admin.specialization')}}</option>
                                        @foreach($pecializations as $spc)
                                          <option value="{{$spc->id}}" @if(old('specialization_id') == $spc->id) selected @endif>{{$spc->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>                           
                                </div>

                                <div class="big-label">{{trans('admin.exper_years')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="exper_years" required placeholder="{{trans('admin.exper_years')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.work_hours')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="work_hours" required placeholder="{{trans('admin.work_hours')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.required_number')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="required_number" required placeholder="{{trans('admin.required_number')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.free_places')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="free_places" required placeholder="{{trans('admin.free_places')}}" />
                                </div>

                                <div class="big-label">{{trans('web.age')}}:</div>
                                <div class="userName">
                                    <input type="number" id="country" name="required_age" required placeholder="{{trans('admin.age')}}" />
                                </div>

                                <div class="big-label">{{trans('web.salary')}} :</div>
                                <div class="userName" disabled>
                                    <input type="text" id="confirm" name="salary" required placeholder="{{trans('admin.salary')}}" />
                                </div>

                                <div class="big-label">{{trans('web.country')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" id="country_id" required name="country_id">
                                        <option value="{{null}}">{{trans('web.country')}}</option>
                                        @foreach($countries as $country)
                                          <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>                           
                                </div>

                                <div class="big-label">{{trans('web.city')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" id="city_id" required name="city_id">
                                        <option value="{{null}}">{{trans('web.city')}}</option>
                                    </select>
                                </div>

                                <div class="big-label">{{trans('admin.description_ar')}} : </div>
                                <div class="userName">
                                    <textarea name="description_ar" id="city_id" required cols="30" rows="6" placeholder="{{trans('admin.description_ar')}}"></textarea>
                                </div>

                                <div class="big-label">{{trans('admin.description_en')}} : </div>
                                <div class="userName">
                                    <textarea name="description_en" id="city_id" required cols="30" rows="6" placeholder="{{trans('admin.description_en')}}"></textarea>
                                </div>

                                <div class="big-label">{{trans('admin.image')}} : </div>
                                <div class="userName">
                                    <input type="file" id="image" name="image"  accept=".gif, .jpg, .png, .webp" />
                                </div>

                            </div>

                            <div class="submit">
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
    </script>
@endsection