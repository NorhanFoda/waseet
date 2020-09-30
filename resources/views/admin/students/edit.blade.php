
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.students')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.students')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('students.update', $std->id)}}">
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
                                            <input type="text" class="form-control" value="{{$std->name}}" placeholder="{{trans('admin.name')}}" name="name" required>
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
                                            <input type="text" class="form-control" value="{{$std->email}}" placeholder="{{trans('admin.email')}}" name="email" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.email')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter email end --}}
                                @php
                                    $arr = explode(',' , $std->phone_main);
                                    $key = $arr[0];
                                    $phone_main = $arr[1];
                                    
                                    $phone_secondary = null;
                                    $sec_key = null;
                                    if($std->phone_secondary != null){
                                        $arr2 = explode(',' , $std->phone_secondary);
                                        $sec_key = $arr2[0];
                                        $phone_secondary = $arr2[1];
                                    }
                                    
                                @endphp
                                {{-- enter phone main --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone_main')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" id="mob" value="{{$key}} {{$phone_main}}" />
                                            <input type="hidden"  class="hidden-in" name="full"/>
                                            <input type="tel" class="form-control phone-input-style" minlength="9" maxlength="11" value="{{$phone_main}}" placeholder="{{trans('admin.phone_main')}}" name="phone_main" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone_main')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone main end --}}

                                {{-- enter phone secondary --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.phone_secondary')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" id="sec_mob" value="{{$sec_key}} {{$phone_secondary}}" />
                                            <input type="hidden"  class="sec_hidden-in" name="sec_full"/>
                                            <input type="tel" class="form-control phone-input-style" minlength="9" maxlength="11" value="{{$phone_secondary}}" placeholder="{{trans('admin.phone_secondary')}}" name="phone_secondary">
                                            <div class="invalid-feedback">
                                                {{trans('admin.phone_secondary')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter phone secondary end --}}

                                {{-- enter age start --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.age')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" value="{{$std->age}}" placeholder="{{trans('admin.age')}}" name="age" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.age')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter age end --}}

                                {{-- select stage start --}}
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>{{trans('admin.stage')}}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="stage_id" id="stage_id" class="form-control" required>
                                                @foreach($stages as $stage)
                                                    <option value="{{$stage->id}}" @if($std->stage_id == $stage->id) selected @endif>{{$stage->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.stage')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- select stage end --}}

                                {{-- other stage --}}
                                <div class="col-12" id="other_stage" @if($std->stage_id != 4) hidden @endif>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.other_stage')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="other_stage" value="{{$std->other_stage}}" class="form-control">
                                            <div class="invalid-feedback">
                                                {{trans('admin.other_stage')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- other stage end --}}

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept=".gif, .jpg, .png, .webp" placeholder="{{trans('admin.image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$std->image ? $std->image->path : '/images/avatar.png'}}" alt="{{$std->name}}"
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
             //show other edu level text input when other edu level is selected
             $('#stage_id').change(function(){
                if($(this).val() == 4){
                    $('#other_stage').attr('hidden', false);
                    $("input[name*='other_stage']").attr('required', true);
                    $("input[name*='other_stage']").val('{{$std->other_stage}}');
                }
                else{
                    $('#other_stage').attr('hidden', true);                
                    $("input[name*='other_stage']").attr('required', false);
                    $("input[name*='other_stage']").val('');
                }
            });
        });
    </script>
@endsection
