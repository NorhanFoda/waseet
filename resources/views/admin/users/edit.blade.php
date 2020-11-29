
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.users')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.users')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('users.update', $user->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">

                                {{-- enter name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$user->name}}" placeholder="{{trans('admin.name')}}" name="name" required>
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
                                            <input type="text" class="form-control" value="{{$user->email}}" placeholder="{{trans('admin.email')}}" name="email" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.email')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter email end --}}

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

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept="image/*" placeholder="{{trans('admin.image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$user->image ? $user->image->path : '/images/avatar.png'}}" alt="{{$user->name}}"
                                            width="100px" height="100px" style="border-radius: 5px">
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
            $('#country_id').change(function(){
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
        });
    </script>
@endsection