@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.bags')}}
@endsection

@section('content')
<div class="content-body">

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
                    <li class="breadcrumb-item active">{{trans('admin.bags')}}
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page users view start -->
    <section class="page-users-view">
        <div class="row">
            <!-- account start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{$bag->{'name_'.session('lang')} }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="users-view-image">
                                <img src="{{$bag->image ? $bag->image : 'images/product-avatar.png'}}" class="users-avatar-shadow rounded mb-2 pr-2 ml-1" 
                                    alt="avatar" style="width:150px; height:150px;">
                            </div>
                            {{trans('admin.rate')}}: {{$bag->ratings->count() > 0 ? ceil($bag->ratings->sum('rate') / $bag->ratings->count()).'/5' : trans('admin.no_ratings')}}
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.bag_category')}}</td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$bag->category->{'name_'.session('lang')} }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.price')}}</td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$bag->price}} {{trans('admin.sr')}}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12">
                                <a href="{{route('bags.edit', $bag->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>


                                <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$bag->id}}'
                                    class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            {{-- description start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-align-right"></i>
                            {{trans('admin.description')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        {{$bag->{'description_'.session('lang')} }}
                    </div>
                </div>
            </div>
            {{-- description end --}}

            {{-- contents start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-align-right"></i>
                            {{trans('admin.contents')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        {!! $bag->{'contents_'.session('lang')} !!}
                    </div>
                </div>
            </div>
            {{-- contents end --}}

            {{-- bemefits start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-align-right"></i>
                            {{trans('admin.benefits')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        {!! $bag->{'benefits_'.session('lang')} !!}
                    </div>
                </div>
            </div>
            {{-- benefits end --}}

            {{-- video start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-video-camera"></i>
                            {{trans('admin.video')}}
                        </h6>
                    </div>
                    <div class="card-body px-75" style="text-align: center;">
                        <video width="220" height="140" poster="{{$bag->poster}}" controls>
                            <source src="{{$bag->video}}" type="video/mp4">
                            <source src="{{$bag->video}}" type="video/ogg">
                            <source src="{{$bag->video}}" type="video/webm">
                        </video>
                    </div>
                </div>
            </div>
            {{-- video end --}}



            {{-- Bag contents start --}}


            {{-- documents start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-file-text-o"></i>
                            {{trans('admin.contents')}}: {{trans('admin.image')}}
                        </h6>
                    </div>
                    <div class="card-body px-75" style="text-align: center;">
                        @foreach($bag->documents as $doc)
                            @php
                                $pdf = explode('/', $doc->path);
                                $file_name = $pdf[count($pdf)-1];
                            @endphp
                            <a href="{{$doc->path}}">
                                <img src="{{asset('admin/images/logo/cv.png')}}" alt="{{$bag->{'name_'.session('lang')} }}" width="65px" height="70pc">
                            </a>
                            <p>{{$file_name}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- documents end --}}


            {{-- images start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-file-image-o"></i>
                            {{trans('admin.contents')}}: {{trans('admin.image')}}
                        </h6>
                    </div>
                    <div class="card-body px-75" style="text-align: center;">
                        @foreach($bag->images as $image)
                            <img src="{{$image->path}}" alt="{{$bag->{'name_'.session('lang')} }}" width="100px" height="100px" style="border-radius: 5px">
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- images end --}}

            {{-- videos start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-video-camera"></i>
                            {{trans('admin.contents')}}: {{trans('admin.video')}}
                        </h6>
                    </div>
                    <div class="card-body px-75" style="text-align: center;">
                        @foreach($bag->videos as $video)
                            <video width="220" height="140" poster="{{$bag->poster}}" controls>
                                <source src="{{$bag->video}}" type="video/mp4">
                                <source src="{{$bag->video}}" type="video/ogg">
                                <source src="{{$bag->video}}" type="video/webm">
                            </video>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- videos end --}}

            {{-- Bag contents end --}}

            <!-- ratings start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-star-half-o"></i>
                            {{trans('admin.rate')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.user')}}</th>
                                        <th>{{trans('admin.rate')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bag->ratings as $rate)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$rate->user->name}}</td>
                                            <td>{{$rate->rate}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ratings end -->
        </div>
    </section>
    <!-- page users view end -->
</div>
@endsection

@section('scripts')
    <script>
        //delete products
        $(document).on('click', '.delete', function (e) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: '{{trans('admin.alert_title')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{trans('admin.yes')}}',
                cancelButtonText: '{{trans('admin.no')}}',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    var id = $(this).attr('object_id');
                    var status = $(this).attr('object_status');
                        token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{route('bags.delete')}}",
                            type: "post",
                            dataType: 'json',
                            data: {"_token": "{{ csrf_token() }}", id: id},
                            success: function(data){
                                if(data.data == 1){
                                    Swal.fire({
                                        type: 'success',
                                        title: '{{trans('admin.deleted')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = '{{route("bags.index")}}';
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = '{{route("bags.index")}}';
                                }
                            }
                        });
                } else if (
                    // / Read more about handling dismissals below /
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: '{{trans('admin.alert_cancelled')}}',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            })
        });
    </script>

@endsection