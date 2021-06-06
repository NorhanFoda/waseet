
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
                                            <img src="{{$slider->image ? $slider->image->path : asset('images/seeding/avatar.png')}}" alt="{{$slider->{'title_'.session('lang')} }}" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

                                {{-- slider appearance --}}
                                <div class="col-12" id="appear">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.slider_appearence')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="type" class="form-control">
                                                <option value="{{null}}">{{trans('admin.slider_appearence')}}</option>
                                                @foreach($options as $option)
                                                    <option value="{{$option}}" @if($slider->type == $option) selected @endif>{{$option}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.slider_appearence')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- slider appearance end --}}

                                {{-- link start --}}
                                <div class="col-12 hidden" id="link">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.link')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" value="{{$slider->link}}" name="link" class="form-control">
                                            <div class="invalid-feedback">
                                                {{trans('admin.link')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- link end --}}

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
            //get the selected option and hide/show link input accoring to its value
            if($('#appear').find(':selected').val() == 'website'){
                $('#link').removeClass('hidden');
            }
            else if($('#appear').find(':selected').val() == 'mobile'){
                $('#link').addClass('hidden');
                $('#link').val('');
            }

            // show the link input if the slider will appear in website and hide the link input if the slider will appear in mobile
            $('#appear').change(function(){
                if($(this).find(':selected').val() == 'website'){
                    $('#link').removeClass('hidden');
                }
                else if($(this).find(':selected').val() == 'mobile'){
                    $('#link').addClass('hidden');
                    $('#link').val('');
                }
            });
        });
    </script>
@endsection
