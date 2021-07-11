
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.add')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.announces')}}
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

    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span style="color:red;">{{$error}}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endforeach

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('admin.add')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('announces.store')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}} ({{trans('admin.h_w')}} : 250 * 1094)</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" accept=".gif, .jpg, .png, .webp" class="form-control" placeholder="{{trans('admin.image')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

                                {{-- enter link start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.link')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" name="link" class="form-control" placeholder="{{trans('admin.link')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.link')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter link end --}}

                                {{-- appear in home page --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.appear_in_home')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="checkbox" name="appear_in_home" id="appear_in_home" class="form-control" checked>
                                            <div class="invalid-feedback">
                                                {{trans('admin.appear_in_home')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- appear in home page end --}}


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