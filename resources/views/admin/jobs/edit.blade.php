
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.jobs')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.jobs')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('jobs.update', $job->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                {{-- enter arabic name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$job->name_ar}}" placeholder="{{trans('admin.name_ar')}}" name="name_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter arabic name end --}}

                                {{-- enter english name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$job->name_en}}" placeholder="{{trans('admin.name_en')}}" name="name_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english name end --}}

                                {{-- enter exper_years --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.exper_years')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->exper_years}}" placeholder="{{trans('admin.exper_years')}}" name="exper_years" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.exper_years')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter exper_years end --}}

                                {{-- work hours --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.work_hours')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->work_hours}}" placeholder="{{trans('admin.work_hours')}}" name="work_hours" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.work_hours')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- work hours end --}}

                                {{-- required number --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.required_number')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->required_number}}" placeholder="{{trans('admin.required_number')}}" name="required_number" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.required_number')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- required number end --}}

                                {{-- free places --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.free_places')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->free_places}}" placeholder="{{trans('admin.free_places')}}" name="free_places" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.free_places')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- free places end --}}

                                {{-- required age --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.age')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->required_age}}" placeholder="{{trans('admin.age')}}" name="required_age" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.age')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- required age end --}}

                                {{-- salary --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.salary')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="1" class="form-control" value="{{$job->salary}}" placeholder="{{trans('admin.salary')}}" name="salary" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.salary')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- salary end --}}

                                {{-- select country start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.country')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="country_id" class="form-control" id="country_id" required>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" @if($job->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.country')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select country end --}}

                                {{-- select city --}}
                                {{-- <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.city')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="city_ids[]" class="form-control" id="city_id" multiple required>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if($job->cities->contains($city->id)) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.city')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.city')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="city_id" class="form-control" id="city_id" required>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @if($job->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.city')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select city end --}}

                                {{-- enter location --}}
                                {{-- <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.location')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="address" value="{{$job->address}}" class="form-control" placeholder="{{trans('admin.location')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.location')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- enter location end --}}

                                {{-- description_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.description_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="description_ar" class="form-control" cols="30" rows="6" placeholder="{{trans('admin.description_ar')}}" required>{{$job->description_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.description_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- description_ar end --}}

                                {{-- description_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.description_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="description_en" class="form-control" cols="30" rows="6" placeholder="{{trans('admin.description_en')}}" required>{{$job->description_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.description_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- description_en end --}}

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept="image/*" placeholder="{{trans('admin.image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.image_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$job->image ? $job->image->path : '/images/product-avatar.png'}}" alt="{{$job->{'name_'.session('lang')} }}"
                                            width="100px" height="100px" style="border-radius: 5px">
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

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