@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.job_seekers')}}
@endsection

@section('content')
<div class="content-body">

    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.job_seekers')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.job_seekers')}}
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
                            {{-- <img src="{{asset('admin/images/logo/cv.png')}}" width="30px" height="40" alt="cv"> --}}
                            {{$seeker->name}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="users-view-image col-md-4">
                                <p>{{trans('admin.email')}}: {{$seeker->email }}</p>
                                <p>{{trans('admin.phone_main')}}: {{$seeker->phone_main }}</p>
                                <p>{{trans('admin.phone_secondary')}}: {{$seeker->phone_secondary }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    {{trans('admin.address')}} : {{$seeker->country->{'name_'.session('lang')} }} - 
                                    {{$seeker->city->{'name_'.session('lang')} }} - {{$seeker->address}}
                                </p>
                                <p>{{trans('admin.salary')}}: {{$seeker->salary_month}} {{trans('admin.sr')}}</p>
                                <p>{{trans('admin.age')}}: {{$seeker->age}} {{trans('admin.years')}}</p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{$seeker->document->path}}">
                                    <img src="{{asset('admin/images/logo/cv.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('seekers.edit', $seeker->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$seeker->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>

                            {{-- <a href="{{$seeker->document->path}}" class="delete btn btn-outline-danger" style="color:white; float:left"><i class="feather icon-edit-1"></i>{{trans('admin.view_cv')}}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- materials jobs start -->
            {{-- <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-book"></i>
                            {{trans('admin.materials')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teacher->materials as $material)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$material->{'name_'.session('lang')} }}</td>
                                            <td>
                                                <a href="{{route('materials.show', $material->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- materials jobs end -->

            <!-- ratings start -->
            {{-- <div class="col-12">
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
                                    @foreach($teacher->ratings as $rate)
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
            </div> --}}
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
                            url: "{{route('seekers.delete')}}",
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

                                    window.location.href = "{{route('seekers.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('seekers.index')}}";
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
                        timer: 1500
                    });
                }
            })
        });
    </script>

@endsection