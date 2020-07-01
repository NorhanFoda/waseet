
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.job_applicants')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.job_applicants')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('applicants.update', $applicant->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">

                                {{-- select applicants --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.job_seekers')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="user_id" class="form-control" required disabled>
                                                @foreach ($seekers as $seeker)
                                                    @if(!$seeker->hasRole('admin'))
                                                        <option value="{{$seeker->id}}" @if($seeker->id == $applicant->id) selected @endif>{{$seeker->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.job_seekers')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select applicants end --}}

                                {{-- select jobs start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.jobs')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="job_ids[]" class="form-control" multiple required>
                                                @foreach ($jobs as $job)
                                                    <option value="{{$job->id}}" @if($applicant->job_applications->contains($job->id)) selected @endif>{{$job->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.jobs')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select jobs end --}}

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
