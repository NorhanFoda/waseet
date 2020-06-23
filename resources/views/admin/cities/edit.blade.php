
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.cities')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.cities')}}
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
        {{session()->flash('error', trans('admin.fields_required'))}}
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('admin.add')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('cities.update', $city->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">

                                {{-- select country --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.country')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}" @if($country->id == $city->country_id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.country')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select country end --}}

                                {{-- enter arabic name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$city->name_ar}}" placeholder="{{trans('admin.name_ar')}}" name="name_ar" required>
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
                                            <input type="text" class="form-control" value="{{$city->name_en}}" placeholder="{{trans('admin.name_en')}}" name="name_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english name end --}}

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