
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.socials')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.socials')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('socials.store')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                {{-- enter link --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.link')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" class="form-control" placeholder="{{trans('admin.link')}}" name="link" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.link')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter link end --}}

                                {{-- appear in footer start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.appear_in_footer')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="checkbox" class="form-control" name="appear_in_footer">
                                            <div class="invalid-feedback">
                                                {{trans('admin.appear_in_footer')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--appear in footer end --}}

                                {{-- enter icon --}}
                                 <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.icon')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="{{trans('admin.icon')}}" name="icon" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.icon')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter icon end --}}

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