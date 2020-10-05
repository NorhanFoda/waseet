
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.job_seekers')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.job_seekers')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.add')}}
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
                <h4 class="card-title">{{trans('admin.add')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('seekers.update', $seeker->id)}}">
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
                                            <input type="text" class="form-control" value="{{$seeker->name}}" placeholder="{{trans('admin.name')}}" name="name" required>
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
                                            <input type="text" class="form-control" value="{{$seeker->email}}" placeholder="{{trans('admin.email')}}" name="email" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.email')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter email end --}}
                                @php
                                    if(strpos($seeker->phone_main, ',') !== false){
                                        $arr = explode(',' , $seeker->phone_main);
                                        $key = $arr[0];
                                        $phone_main = $arr[1];
                                    }
                                    else{
                                        $key = '';
                                        $phone_main = $seeker->$phone_main;
                                    }
                                    
                                    $phone_secondary = null;
                                    $sec_key = null;
                                    if($seeker->phone_secondary != null && strpos($seeker->phone_secondary, ',') !== false){
                                        $arr2 = explode(',' , $seeker->phone_secondary);
                                        $sec_key = $arr2[0];
                                        $phone_secondary = $arr2[1];
                                    }
                                    else{
                                        $sec_key = '';
                                        $phone_secondary = $seeker->$phone_secondary;
                                    }
                                    
                                @endphp
                                {{-- enter phone main --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone_main')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" id="mob" value="{{$key}} {{$phone_main}}" />
                                            <input type="hidden"  class="hidden-in" name="full"/>
                                            <input type="tel" class="form-control phone-input-style" minlength="9" maxlength="11" value="{{$phone_main}}" placeholder="{{trans('admin.phone_main')}}" name="phone_main" required>
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
                                            <input type="hidden" id="sec_mob" value="{{$sec_key}} {{$phone_secondary}}" />
                                            <input type="hidden"  class="sec_hidden-in" name="sec_full"/>
                                            <input type="tel" class="form-control phone-input-style" minlength="9" maxlength="11" value="{{$phone_secondary}}" placeholder="{{trans('admin.phone_secondary')}}" name="phone_secondary">
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
                                            <input type="number" class="form-control" value="{{$seeker->exper_years}}" placeholder="{{trans('admin.exper_years')}}" name="exper_years" required>
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
                                            <input type="number" class="form-control" value="{{$seeker->age}}" placeholder="{{trans('admin.age')}}" name="age" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.age')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter age end --}}

                                {{-- select country start --}}
                                {{-- <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.country')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="country_id" class="form-control" id="country_id" required>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" @if($seeker->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
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
                                                    <option value="{{$city->id}}" @if($seeker->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.city')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- select city end --}}

                                {{-- enter address --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.location')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$seeker->address}}" placeholder="{{trans('admin.location')}}" name="address" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.location')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter location end --}}

                                {{-- expected salary start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.salary')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" value="{{$seeker->salary_month}}" placeholder="{{trans('admin.salary')}}" name="salary_month" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.salary')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- expected salary end --}}

                                {{-- enter cv --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.cv')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="cv" value="{{$seeker->document->path}}" class="form-control" accept="application/pdf" placeholder="{{trans('admin.cv')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.cv')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter cv end --}}

                                {{-- enter location --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.location')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$seeker->address}}" placeholder="{{trans('admin.location')}}" name="address" required>
                                            <input type="hidden" name="lat" value="{{$seeker->lat}}" id="location_lat">
                                            <input type="hidden" name="long" value="{{$seeker->long}}" id="location_lng"> 
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