
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.static_pages')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.static_pages')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('static_pages.update', $page->id)}}">
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
                                            <input type="text" class="form-control" value="{{$page->name_ar}}" placeholder="{{trans('admin.name_ar')}}" name="name_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_ar')}}
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
                                            <input type="text" class="form-control" value="{{$page->name_en}}" placeholder="{{trans('admin.name_en')}}" name="name_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english name end --}}

                                {{-- enter english short_description_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.short_description_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="short_description_ar" class="form-control" cols="30" rows="6" required>{{$page->short_description_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.short_description_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english short_description_ar end --}}

                                {{-- enter english short_description_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.short_description_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="short_description_en" class="form-control" cols="30" rows="6" required>{{$page->short_description_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.short_description_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english short_description_en end --}}

                                {{-- enter english full_description_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.full_description_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="full_description_ar" class="form-control myTextArea" cols="30" rows="6" required>{{$page->full_description_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.full_description_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english full_description_ar end --}}

                                {{-- enter english full_description_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.full_description_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="full_description_en" class="form-control myTextArea" cols="30" rows="6" required>{{$page->full_description_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.full_description_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english full_description_en end --}}

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