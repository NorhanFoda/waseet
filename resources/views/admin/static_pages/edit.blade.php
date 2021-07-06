
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

                                {{-- enter english vision_ar --}}
                                <div class="col-12 about_us">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.vision_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="vision_ar" class="form-control myTextArea" cols="30" rows="6" @if($page->id == 1) required @endif>{{$page->vision_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.vision_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english vision_ar end --}}

                                {{-- enter english vision_en --}}
                                <div class="col-12 about_us">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.vision_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="vision_en" class="form-control myTextArea" cols="30" rows="6" @if($page->id == 1) required @endif>{{$page->vision_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.vision_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english vision_en end --}}

                                {{-- enter english message_ar --}}
                                <div class="col-12 about_us">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.message_ar')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="message_ar" class="form-control myTextArea" cols="30" rows="6" @if($page->id == 1) required @endif>{{$page->message_ar}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.message_ar')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english message_ar end --}}

                                {{-- enter english message_en --}}
                                <div class="col-12 about_us">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <span>{{trans('admin.message_en')}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="message_en" class="form-control myTextArea" cols="30" rows="6" @if($page->id == 1) required @endif>{{$page->message_en}}</textarea>
                                            <div class="invalid-feedback">
                                                {{trans('admin.message_en')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- enter english message_en end --}}

                                <div class="col-12 about_us">
                                    {{-- goals ar --}}
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{trans('admin.goals_ar')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="input-group control-group goal_increment">
                                                    <div class="col-md-12">
                                                        <!--<input type="text" name="title_ars[]" class="form-control" placeholder="{{trans('admin.title_ar')}}" @if($page->id == 1) required @endif>-->
                                                        <input type="text" name="title_ars[]" class="form-control" placeholder="{{trans('admin.title_ar')}}">
                                                        <div class="invalid-feedback">
                                                            {{trans('admin.title_ar')}}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <!--<textarea name="text_ars[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_ar')}}" @if($page->id == 1) required @endif></textarea>-->
                                                        <textarea name="text_ars[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_ar')}}"></textarea>
                                                        <div class="invalid-feedback">
                                                            {{trans('admin.text_ar')}}
                                                        </div>
                                                    </div>
                                                    <div class="input-group-btn"> 
                                                        <button class="btn btn-success goal-btn-success" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                                <div class="goal_clone hidden">
                                                    <div class="control-group input-group" style="margin-top:10px">
                                                        <div class="col-md-12">
                                                            <input type="text" name="title_ars[]" class="form-control" placeholder="{{trans('admin.title_ar')}}">
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <textarea name="text_ars[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_ar')}}"></textarea>
                                                        </div>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger goal-btn-danger" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-10 offset-md-2">
                                                @foreach ($page->goals as $goal)
                                                    <div class="delete_image_clone delete_goal">
                                                        <div class="control-group input-group" style="margin-top:10px">
                                                            <div class="col-md-12">
                                                                <input type="text" value="{{$goal->title_ar}}" class="form-control" placeholder="{{trans('admin.title_ar')}}">
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <div class="col-md-12">
                                                                <textarea cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_ar')}}">{{$goal->text_ar}}</textarea>
                                                            </div>
                                                            <div class="input-group-btn"> 
                                                                <button class="btn btn-danger delete-goal-btn-danger" onClick="deleteGoal({{$goal->id}})" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- goals ar end --}}

                                    {{-- goals en --}}
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{trans('admin.goals_en')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="input-group control-group goal_increment">
                                                    <div class="col-md-12">
                                                        <!--<input type="text" name="title_ens[]" class="form-control" placeholder="{{trans('admin.title_en')}}" @if($page->id == 1) required @endif>-->
                                                        <input type="text" name="title_ens[]" class="form-control" placeholder="{{trans('admin.title_en')}}">
                                                        <div class="invalid-feedback">
                                                            {{trans('admin.title_en')}}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <!--<textarea name="text_ens[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_en')}}" @if($page->id == 1) required @endif></textarea>-->
                                                        <textarea name="text_ens[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_en')}}"></textarea>
                                                        <div class="invalid-feedback">
                                                            {{trans('admin.text_en')}}
                                                        </div>
                                                    </div>
                                                    <div class="input-group-btn"> 
                                                        <button class="btn btn-success goal-btn-success" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                                <div class="goal_clone hidden">
                                                    <div class="control-group input-group" style="margin-top:10px">
                                                        <div class="col-md-12">
                                                            <input type="text" name="title_ens[]" class="form-control" placeholder="{{trans('admin.title_en')}}">
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <textarea name="text_ens[]" cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_en')}}"></textarea>
                                                        </div>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger goal-btn-danger" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-10 offset-md-2">
                                                @foreach ($page->goals as $goal)
                                                    <div class="delete_image_clone delete_goal">
                                                        <div class="control-group input-group" style="margin-top:10px">
                                                            <div class="col-md-12">
                                                                <input type="text" value="{{$goal->title_en}}" class="form-control" placeholder="{{trans('admin.title_en')}}">
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <div class="col-md-12">
                                                                <textarea cols="30" rows="6" class="form-control MyTextArea" placeholder="{{trans('admin.text_en')}}">{{$goal->text_ar}}</textarea>
                                                            </div>
                                                            <div class="input-group-btn"> 
                                                                <button class="btn btn-danger delete-goal-btn-danger" onClick="deleteGoal({{$goal->id}})" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- goals ar end --}}
                                </div>

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
             //add multi goals
             $(".goal-btn-success").click(function(){ 
                var html = $(".goal_clone").html();
                $(".goal_increment").after(html);
            });

            $("body").on("click",".goal-btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });

            if('{{$page->id}}' == 1){
                $('.about_us').removeAttr('hidden');
            }
            else{
                $('.about_us').attr("hidden",true);
            }
        });

        function deleteGoal(id){
            $.ajax({
                url: "{{route('goals.delete')}}",
                type: "POST",
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}", id: id },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.data == 1){
                        Swal.fire({
                            title: "{{ trans('admin.deleted')}}",
                            type: 'success',
                            timer: 1500,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                    else{
                        Swal.fire({
                            title: "{{trans('admin.error')}}",
                            type: 'error',
                            timer: 1500,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        }
    </script>
@endsection