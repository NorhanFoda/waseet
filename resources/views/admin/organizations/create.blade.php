
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.organizations')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.organizations')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('organizations.store')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                {{-- organization type start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.organization_type')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="edu_type_id" class="form-control" id="edu_type_id" required>
                                                @foreach ($edu_types as $type)
                                                    <option value="{{$type->id}}">{{$type->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.organization_type')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- organization type end --}}

                                {{-- enter other organization type start --}}
                                <div class="col-12" id="other_organization_type" hidden>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="other_organization_type_text" name="other_edu_type" placeholder="{{trans('admin.organization_type')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.organization_type')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter other organization type end --}}

                                {{-- enter name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="{{trans('admin.name')}}" name="name" required>
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
                                            <input type="text" class="form-control" placeholder="{{trans('admin.email')}}" name="email" required>
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
                                            <input type="tel" class="form-control" placeholder="{{trans('admin.phone_main')}}" name="phone_main" required>
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
                                            <input type="tel" class="form-control" placeholder="{{trans('admin.phone_secondary')}}" name="phone_secondary">
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone_secondary')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone secondary end --}}

                                {{-- enter password --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.password')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" placeholder="{{trans('admin.password')}}" name="password">
                                            <div class="invalid-feedback">
                                                {{trans('admin.password')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.password_confirmation')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" placeholder="{{trans('admin.password_confirmation')}}" name="password_confirmation">
                                            <div class="invalid-feedback">
                                                {{trans('admin.password_confirmation')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter password end --}}

                                {{-- select country  --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.country')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="country_id" class="form-control" id="country_id">
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->{'name_'.session('lang')} }}</option>
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
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.city')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="city_id" class="form-control" id="city_id">
                                                @foreach ($countries[0]->cities as $city)
                                                    <option value="{{$city->id}}">{{$city->{'name_'.session('lang')} }}</option>
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
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.location')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="{{trans('admin.location')}}" name="address" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.location')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter location end --}}

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
            $(document).on('change', '#country_id', function(){
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

            $(document).on('change', '#edu_type_id', function(){
                if($(this).val() == 4){
                    $(this).removeAttr('required');
                    $('#other_organization_type').removeAttr('hidden');
                    $('#other_organization_type_text').attr('required', 'required');
                }
                else{
                    $(this).attr('required', 'required');
                    $('#other_organization_type').attr('hidden', 'hidden');
                    $('#other_organization_type_text').removeAttr('required');
                }
            });
        });
    </script>
@endsection