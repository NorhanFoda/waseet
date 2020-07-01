
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.slider')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.slider')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('sliders.update', $slider->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                {{-- enter arabic title --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$slider->title_ar}}" placeholder="{{trans('admin.title_ar')}}" name="title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter arabic title end --}}

                                {{-- enter english title --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$slider->title_en}}" placeholder="{{trans('admin.title_en')}}" name="title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english title end --}}

                                {{-- enter arabic body --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.body_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="body_ar" cols="30" rows="6" placeholder="{{trans('admin.body_ar')}}" class="form-control" required>{{$slider->body_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.body_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter arabic body end --}}

                                {{-- enter english body --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.body_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="body_en" cols="30" rows="6" placeholder="{{trans('admin.body_en')}}" class="form-control" required>{{$slider->body_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.body_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english body end --}}

                                 {{-- enter image --}}
                                 <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept="image/*" placeholder="{{trans('admin.image')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$slider->image->path}}" alt="{{$slider->{'title_'.session('lang')} }}" width="200px" height="100px">
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