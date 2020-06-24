
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.bags')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.bags')}}
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
        {{session()->flash('error', trans('admin.fields_required'))}}
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('admin.add')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('bags.store')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                {{-- bag categories start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.bag_categories')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="bag_category_id" class="form-control">
                                                @foreach ($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->{'name_'.session('lang')} }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{trans('admin.bag_categories')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- bag categories end --}}


                                {{-- enter arabic name --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.name_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="{{trans('admin.name_ar')}}" name="name_ar" required>
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
                                            <input type="text" class="form-control" placeholder="{{trans('admin.name_en')}}" name="name_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.name_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english name end --}}

                                {{-- enter description_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.description_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="description_ar" class="form-control" cols="30" rows="6" placeholder="{{trans('admin.description_ar')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.description_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter description_ar end --}}

                                {{-- enter description_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.description_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="description_en" class="form-control" cols="30" rows="6" placeholder="{{trans('admin.description_en')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.description_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter description_en end --}}

                                {{-- contents_ar start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contents_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="contents_ar" class="form-control myTextArea" cols="30" rows="6" placeholder="{{trans('admin.contents_ar')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contents_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contents_ar end --}}

                                {{-- contents_en start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contents_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="contents_en" class="form-control myTextArea" cols="30" rows="6" placeholder="{{trans('admin.contents_en')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contents_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contents_en end --}}

                                {{-- benefits_ar start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.benefits_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="benefits_ar" class="form-control myTextArea" cols="30" rows="6" placeholder="{{trans('admin.benefits_ar')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.benefits_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- benefits_ar end --}}

                                {{-- benefits_en start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.benefits_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="benefits_en" class="form-control myTextArea" cols="30" rows="6" placeholder="{{trans('admin.benefits_en')}}" required></textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.benefits_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- benefits_en end --}}

                                {{-- price start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.price')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" step="0.1" class="form-control" placeholder="{{trans('admin.price')}}" name="price" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.price')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- proce end --}}

                                {{-- enter image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control" accept="image/*" placeholder="{{trans('admin.image')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.image_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter image end --}}

                                {{-- video start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.video')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="video" class="form-control" accept="video/*" placeholder="{{trans('admin.video')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.video_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- video end --}}

                                {{-- enter video poster start --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.poster')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="poster" class="form-control" accept="image/*" placeholder="{{trans('admin.poster')}}" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.poster_required')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter video poster end --}}


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