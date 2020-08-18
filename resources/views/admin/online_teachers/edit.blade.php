@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.online_teachers')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.online_teachers')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.edit')}}
                    </li>
                </ol>
            </div>
        </div>
    </div>

    @if(count($errors->all()) > 0)
        @foreach($errors->all() as $error)
            {{session()->flash('error', $error)}}
        @endforeach
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('admin.edit')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('online_teachers.update', $teacher->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">

                                {{-- enter name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$teacher->name}}" placeholder="{{trans('admin.name')}}" name="name" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter name end --}}

                                {{-- enter email --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.email')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$teacher->email}}" placeholder="{{trans('admin.email')}}" name="email" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.email')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter email end --}}

                                {{-- enter phone main --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone_main')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="tel" class="form-control" value="{{$teacher->phone_main}}" placeholder="{{trans('admin.phone_main')}}" name="phone_main" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone_main')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone main end --}}

                                {{-- enter phone secondary --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone_secondary')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="tel" class="form-control" value="{{$teacher->phone_secondary}}" placeholder="{{trans('admin.phone_secondary')}}" name="phone_secondary">
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone_secondary')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone secondary end --}}

                                {{-- enter experience years start --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.exper_years')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" value="{{$teacher->exper_years}}" placeholder="{{trans('admin.exper_years')}}" name="exper_years" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.exper_years')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter experience years end --}}

                                {{-- enter age start --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.age')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" value="{{$teacher->age}}" placeholder="{{trans('admin.age')}}" name="age" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.age')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter age end --}}

                                {{-- enter edu level start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.edu_level')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="edu_level_id" id="edu_level_id" class="form-control" required>
                                                @foreach($levels as $level)
                                                    <option value="{{$level->id}}" @if($teacher->edu_level_id == $level->id) selected @endif>{{$level->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.edu_level')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter edu level end --}}

                                {{-- other edu_level --}}
                                <div class="col-12" id="other_edu_level" @if($teacher->edu_level_id != 4) hidden @endif>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.other_edu_level')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="other_edu_level" value="{{$teacher->other_edu_level}}" class="form-control">
                                            <div class="invalid-feedback">
                                                {{trans('admin.other_edu_level')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- other edu_level end --}}

                                {{-- enter material start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.materials')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="material_ids[]" id="material_id" class="form-control" multiple required>
                                                @foreach($materials as $material)
                                                        <option value="{{$material->id}}" @if($teacher->materials->contains($material->id)) selected @endif>{{$material->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.materials')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter material end --}}

                                {{-- other other_material --}}
                                <div class="col-12" id="other_material" @if(!$teacher->materials->contains(4)) hidden @endif>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.other_material')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="other_material" value="{{$teacher->materials()->where('material_id', 4)->first()->pivot->other_material}}" class="form-control">
                                            <div class="invalid-feedback">
                                                {{trans('admin.other_material')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- other other_material end --}}

                                {{-- select nationality start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.nationality')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="nationality_id" id="nationality_id" class="form-control" required>
                                                @foreach($nationalities as $nation)
                                                    <option value="{{$nation->id}}" @if($teacher->nationality_id == $nation->id) selected @endif>{{$nation->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.nationality')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select nationality end --}}

                                {{-- other other nationality --}}
                                <div class="col-12" id="other_nationality" @if($teacher->nationality_id != 3) hidden @endif>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.other_nationality')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="other_nationality" value="{{$teacher->other_nationality}}" class="form-control">
                                            <div class="invalid-feedback">
                                                {{trans('admin.other_nationality')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- other other nationality end --}}

                                {{-- select country start --}}
                                {{-- <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.country')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="country_id" class="form-control" id="country_id" required>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" @if($teacher->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.country')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- select country end --}}

                                {{-- select city --}}
                                {{-- <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.city')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="city_id" class="form-control" id="city_id" required>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if($teacher->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.city')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- select city end --}}

                                {{-- bio_ar start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.bio_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="bio_ar" cols="30" rows="6" class="form-control" placeholder="{{trans('admin.bio_ar')}}">{{$teacher->bio_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.bio_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- bio_ar end --}}

                                {{-- bio_en start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.bio_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="bio_en" cols="30" rows="6" class="form-control" placeholder="{{trans('admin.bio_en')}}">{{$teacher->bio_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.bio_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- bio_en end --}}

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept=".gif, .jpg, .png, .webp" placeholder="{{trans('admin.image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.image_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$teacher->image ? $teacher->image->path : '/images/avatar.png'}}" 
                                                width="100px" height="100px" style="border-radius: 5px" alt="{{$teacher->name}}">
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

                                {{-- enter address --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.location')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$teacher->address}}" placeholder="{{trans('admin.location')}}" name="address" required>
                                            <input type="hidden" name="lat" value="{{$teacher->lat}}" id="location_lat">
                                            <input type="hidden" name="long" value="{{$teacher->long}}" id="location_lng"> 
                                            <div class="invalid-feedback">
                                                {{trans('admin.location')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter location end --}}

                                {{-- map start --}}
                                <div class="col-12">
                                    <div class="map-div">
                                        <div id="gmap" style="width:100%;height:400px;">
                                    </div>
                                </div>
                                {{-- map end --}}

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">{{trans('admin.save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
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

            //show other edu level text input when other edu level is selected
            $('#edu_level_id').change(function(){
                if($(this).val() == 4){
                    $('#other_edu_level').attr('hidden', false);
                    $("input[name*='other_edu_level']").attr('required', true);
                    $("input[name*='other_edu_level']").val('{{$teacher->other_edu_level}}');
                }
                else{
                    $('#other_edu_level').attr('hidden', true);                
                    $("input[name*='other_edu_level']").attr('required', false);
                    $("input[name*='other_edu_level']").val('');
                }
            });

            // Show other material text input when other material is selected
            $('#material_id').change(function(){
                var ids = $(this).val();
                if(ids.indexOf('4') != -1){
                    $('#other_material').attr('hidden', false);
                    $("input[name*='other_material']").attr('required', true);
                    $("input[name*='other_material']").val('{{$teacher->materials()->where('material_id', 4)->first()->pivot->other_material}}');
                }
                else{
                    $('#other_material').attr('hidden', true);                
                    $("input[name*='other_material']").attr('required', false);
                    $("input[name*='other_material']").val('');
                }
            });

            //show other edu level text input when other edu level is selected
            $('#nationality_id').change(function(){
                if($(this).val() == 3){
                    $('#other_nationality').attr('hidden', false);
                    $("input[name*='other_nationality']").attr('required', true);
                    $("input[name*='other_nationality']").val('{{$teacher->other_nationality}}');
                }
                else{
                    $('#other_nationality').attr('hidden', true);                
                    $("input[name*='other_nationality']").attr('required', false);
                    $("input[name*='other_nationality']").val('');
                }
            });
        });
    </script>
@endsection