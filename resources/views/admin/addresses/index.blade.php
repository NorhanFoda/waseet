
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
{{trans('admin.addresses')}}
@endsection

@section('content')

    <div class="row" style="display:block">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    {{trans('admin.addresses')}}
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.addresses')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 dt-responsive nowrap data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.role')}}</th>
                                    <th>{{trans('admin.address')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($addresses as $address)
                                        @if(!$address->user->hasRole('admin'))
                                            <tr align="center">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$address->user->name}}</td>
                                                <td>
                                                    @if($address->user->hasRole('student'))
                                                        {{trans('admin.student')}}
                                                    @endif
                                                    @if($address->user->hasRole('online_teacher'))
                                                        {{trans('admin.online_teacher')}}
                                                    @endif
                                                    @if($address->user->hasRole('direct_teacher'))
                                                        {{trans('admin.direct_teacher')}}
                                                    @endif
                                                    @if($address->user->hasRole('job_seeker'))
                                                        {{trans('admin.job_seeker')}}
                                                    @endif
                                                    @if($address->user->hasRole('organization'))
                                                        {{trans('admin.organization')}}
                                                    @endif
                                                    @if($address->user->roles->count() == 0)
                                                        {{trans('admin.visitor')}}
                                                    @endif
                                                </td>
                                                <td>{{$address->country ? $address->country->{'name_'.session('lang')} : '-' }} -
                                                        {{$address->city ? $address->city->{'name_'.session('lang')} : '-' }} -
                                                        {{$address->address}} -
                                                        {{trans('web.ps')}} : {{$address->postal_code}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
