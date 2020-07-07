
@extends('admin.layouts.app')

@section('pageTitle'){{trans('admin.home')}}
@endsection

@section('pageSubTitle') {{trans('admin.setting')}}
@endsection

@section('content')

<div class="row" style="display:block">


    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.setting')}}
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
                    <form class="form form-horizontal needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('setting.update')}}">
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                {{--------------------------------- Arabic data start ---------------------------------}}

                                {{-- welcome_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.welcome_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->welcome_text_ar}}" placeholder="{{trans('admin.welcome_text_ar')}}" name="welcome_text_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.welcome_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- welcome_text_ar end --}}

                                {{-- text_before_add_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.text_before_add_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="text_before_add_ar" {{trans('admin.text_before_add_ar')}} class="form-control" cols="30" rows="6" required>{{$set->text_before_add_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.text_before_add_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- text_before_add_ar end --}}

                                 {{-- text_after_add_ar --}}
                                 <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.text_after_add_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="text_after_add_ar" {{trans('admin.text_after_add_ar')}} class="form-control" cols="30" rows="6" required>{{$set->text_after_add_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.text_after_add_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- text_after_add_ar end --}}

                                {{-- section_1_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_1_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_1_title_ar}}" placeholder="{{trans('admin.section_1_title_ar')}}" name="section_1_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_1_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_1_title_ar end --}}

                                {{-- section_1_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_1_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_1_text_ar" {{trans('admin.section_1_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->section_1_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_1_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_1_text_ar end --}}

                                {{-- step_1_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_1_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_1_title_ar}}" placeholder="{{trans('admin.step_1_title_ar')}}" name="step_1_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_1_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_1_title_ar end --}}

                                {{-- step_1_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_1_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_1_text_ar" {{trans('admin.step_1_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->step_1_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_1_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_1_text_ar end --}}

                                {{-- step_2_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_2_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_2_title_ar}}" placeholder="{{trans('admin.step_2_title_ar')}}" name="step_2_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_2_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_2_title_ar end --}}

                                {{-- step_2_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_2_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_2_text_ar" {{trans('admin.step_2_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->step_2_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_2_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_2_text_ar end --}}

                                {{-- step_3_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_3_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_3_title_ar}}" placeholder="{{trans('admin.step_3_title_ar')}}" name="step_3_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_3_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_3_title_ar end --}}

                                {{-- step_3_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_3_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_3_text_ar" {{trans('admin.step_3_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->step_3_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_3_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_3_text_ar end --}}

                                {{-- section_2_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_2_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_2_title_ar}}" placeholder="{{trans('admin.section_2_title_ar')}}" name="section_2_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_2_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_2_title_ar end --}}

                                {{-- section_2_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_2_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_2_text_ar" {{trans('admin.section_2_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->section_2_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_2_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_2_text_ar end --}}

                                {{-- section_3_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_3_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_3_title_ar}}" placeholder="{{trans('admin.section_3_title_ar')}}" name="section_3_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_3_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_3_title_ar end --}}

                                {{-- section_3_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_3_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_3_text_ar" {{trans('admin.section_3_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->section_3_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_3_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_3_text_ar end --}}

                                {{-- footer_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.footer_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->footer_text_ar}}" placeholder="{{trans('admin.footer_text_ar')}}" name="footer_text_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.footer_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- footer_text_ar end --}}

                                {{-- contact_us_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contact_us_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->contact_us_title_ar}}" placeholder="{{trans('admin.contact_us_title_ar')}}" name="contact_us_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contact_us_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contact_us_title_ar end --}}

                                {{-- contact_us_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contact_us_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="contact_us_text_ar" {{trans('admin.contact_us_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->contact_us_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contact_us_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contact_us_text_ar end --}}

                                {{-- saved_title_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.saved_title_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->saved_title_ar}}" placeholder="{{trans('admin.saved_title_ar')}}" name="saved_title_ar" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.saved_title_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- saved_title_ar end --}}

                                {{-- saved_text_ar --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.saved_text_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="saved_text_ar" {{trans('admin.saved_text_ar')}} class="form-control" cols="30" rows="6" required>{{$set->saved_text_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.saved_text_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- saved_text_ar end --}}

                                {{--------------------------------- Arabic data end ---------------------------------}}

                                {{--------------------------------- English data start -------------------------------}}
                                {{-- welcome_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.welcome_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->welcome_text_en}}" placeholder="{{trans('admin.welcome_text_en')}}" name="welcome_text_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.welcome_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- welcome_text_en end --}}

                                {{-- text_before_add_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.text_before_add_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="text_before_add_en" {{trans('admin.text_before_add_en')}} class="form-control" cols="30" rows="6" required>{{$set->text_before_add_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.text_before_add_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- text_before_add_en end --}}

                                 {{-- text_after_add_en --}}
                                 <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.text_after_add_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="text_after_add_en" {{trans('admin.text_after_add_en')}} class="form-control" cols="30" rows="6" required>{{$set->text_after_add_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.text_after_add_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- text_after_add_en end --}}

                                {{-- section_1_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_1_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_1_title_en}}" placeholder="{{trans('admin.section_1_title_en')}}" name="section_1_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_1_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_1_title_en end --}}

                                {{-- section_1_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_1_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_1_text_en" {{trans('admin.section_1_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->section_1_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_1_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_1_text_en end --}}

                                {{-- step_1_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_1_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_1_title_en}}" placeholder="{{trans('admin.step_1_title_en')}}" name="step_1_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_1_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_1_title_en end --}}

                                {{-- step_1_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_1_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_1_text_en" {{trans('admin.step_1_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->step_1_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_1_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_1_text_en end --}}

                                {{-- step_2_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_2_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_2_title_en}}" placeholder="{{trans('admin.step_2_title_en')}}" name="step_2_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_2_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_2_title_en end --}}

                                {{-- step_2_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_2_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_2_text_en" {{trans('admin.step_2_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->step_2_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_2_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_2_text_en end --}}

                                {{-- step_3_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_3_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->step_3_title_en}}" placeholder="{{trans('admin.step_3_title_en')}}" name="step_3_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_3_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_3_title_en end --}}

                                {{-- step_3_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_3_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="step_3_text_en" {{trans('admin.step_3_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->step_3_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_3_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- step_3_text_en end --}}

                                {{-- section_2_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_2_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_2_title_en}}" placeholder="{{trans('admin.section_2_title_en')}}" name="section_2_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_2_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_2_title_en end --}}

                                {{-- section_2_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_2_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_2_text_en" {{trans('admin.section_2_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->section_2_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_2_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_2_text_en end --}}

                                {{-- section_3_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_3_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->section_3_title_en}}" placeholder="{{trans('admin.section_3_title_en')}}" name="section_3_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_3_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_3_title_en end --}}

                                {{-- section_3_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.section_3_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="section_3_text_en" {{trans('admin.section_3_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->section_3_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.section_3_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- section_3_text_en end --}}

                                {{-- footer_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.footer_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->footer_text_en}}" placeholder="{{trans('admin.footer_text_en')}}" name="footer_text_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.footer_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- footer_text_en end --}}

                                {{-- contact_us_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contact_us_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->contact_us_title_en}}" placeholder="{{trans('admin.contact_us_title_en')}}" name="contact_us_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contact_us_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contact_us_title_en end --}}

                                {{-- contact_us_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.contact_us_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="contact_us_text_en" {{trans('admin.contact_us_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->contact_us_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.contact_us_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- contact_us_text_en end --}}

                                {{-- saved_title_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.saved_title_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{$set->saved_title_en}}" placeholder="{{trans('admin.saved_title_en')}}" name="saved_title_en" required>
                                            <div class="invalid-feedback">
                                                {{trans('admin.saved_title_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- saved_title_en end --}}

                                {{-- saved_text_en --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.saved_text_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="saved_text_en" {{trans('admin.saved_text_en')}} class="form-control" cols="30" rows="6" required>{{$set->saved_text_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.saved_text_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- saved_text_en end --}}

                                {{--------------------------------- English data end -------------------------------}}

                                {{-- header_logo --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.header_logo')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="header_logo" class="form-control" accept="image/*" placeholder="{{trans('admin.header_logo')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.header_logo')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->header_logo}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- header_logo end --}}

                                {{-- footer_logo --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.footer_logo')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="footer_logo" class="form-control" accept="image/*" placeholder="{{trans('admin.footer_logo')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.footer_logo')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->footer_logo}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- footer_logo end --}}

                                {{-- text_after_add_image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.text_after_add_image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="text_after_add_image" class="form-control" accept="image/*" placeholder="{{trans('admin.text_after_add_image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.text_after_add_image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->text_after_add_image}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- text_after_add_image end --}}

                                {{-- step_1_image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_1_image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="step_1_image" class="form-control" accept="image/*" placeholder="{{trans('admin.step_1_image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_1_image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->step_1_image}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- step_1_image end --}}

                                {{-- step_2_image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_2_image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="step_2_image" class="form-control" accept="image/*" placeholder="{{trans('admin.step_2_image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_2_image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->step_2_image}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- step_2_image end --}}

                                {{-- step_3_image --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.step_3_image')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="step_3_image" class="form-control" accept="image/*" placeholder="{{trans('admin.step_3_image')}}">
                                            <div class="invalid-feedback">
                                                {{trans('admin.step_3_image')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <img src="{{$set->step_3_image}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                </div>
                                {{-- step_3_image end --}}

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