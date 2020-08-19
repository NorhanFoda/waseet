@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.notifications')}}
@endsection

@section('content')

    <!--start div-->
    <div class="row" style="display:block">

        <div class="row breadcrumbs-top m-2">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{trans('admin.users')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/admin/home">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.notify')}}
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
                    <h4 class="card-title">{{trans('admin.notify')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('notifications.store')}}">
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{trans('admin.msg_ar')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="msg_ar" cols="30" rows="6" class="form-control" placeholder="{{trans('admin.msg_ar')}}" required></textarea>
                                                <div class="invalid-feedback">
                                                    {{trans('admin.msg_ar')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{trans('admin.msg_en')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="msg_en" cols="30" rows="6" class="form-control" placeholder="{{trans('admin.msg_en')}}" required></textarea>
                                                <div class="invalid-feedback">
                                                    {{trans('admin.msg_en')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- image --}}
                                    {{-- <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{trans('admin.image')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="image" class="form-control" accept=".gif, .jpg, .png, .webp" required>
                                                <div class="invalid-feedback">
                                                    {{trans('admin.product_image')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- image end --}}

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">{{trans('admin.send')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
