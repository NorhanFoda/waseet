
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.bank_receipt')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.bank_receipt')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        {{-- <a href="{{route('admin.banks')}}">{{trans('admin.banks')}}</a> --}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('register.store_receipt')}}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <input type="hidden" name="type" value="{{$type}}">

                        <div class="form-body">
                            <div class="row">

                                {{-- select banks --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.banks')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="bank_id" class="form-control">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.banks')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select banks end --}}

                                {{-- enter full name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.full_name')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="{{trans('admin.full_name')}}" name="name" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.full_name')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter full name end --}}

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

                                {{-- enter phone --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="{{trans('admin.phone')}}" name="phone" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone end --}}

                                {{-- enter cost --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.cost')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="{{trans('admin.cost')}}" name="cost" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.cost')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter cost end --}}

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.receipt_image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" required class="form-control" accept=".gif, .jpg, .png, .webp" placeholder="{{trans('admin.receipt_image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.receipt_image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

                                {{-- enter details --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.details')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="details" class="form-control" placeholder="{{trans('admin.details')}}" role="6" cols="30" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.details')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter details end --}}

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