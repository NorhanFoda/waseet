@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.nationalities')}}
@endsection

@section('content')
<div class="content-body">

    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.nationalities')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.nationalities')}}
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
                            {{$nation->{'name_'.session('lang')} }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('nationalities.edit', $nation->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$nation->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- online teachers start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-users"></i>
                            {{trans('admin.online_teachers')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nation->users as $user)
                                        @if($user->hasrole('online_teacher'))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_main}}</td>
                                                <td>
                                                    <a href="{{route('online_teachers.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
            <!-- online teachers end -->

            <!-- direct teachers start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-users"></i>
                            {{trans('admin.direct_teachers')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nation->users as $user)
                                        @if($user->hasrole('direct_teacher'))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_main}}</td>
                                                <td>
                                                    <a href="{{route('direct_teachers.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
            <!-- direct teachers end -->

            <!-- students start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-graduation-cap"></i>
                            {{trans('admin.students')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nation->users as $user)
                                        @if($user->hasrole('student'))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_main}}</td>
                                                <td>
                                                    <a href="{{route('students.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
            <!-- students end -->

            {{-- organizations start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-university"></i>
                            {{trans('admin.organizations')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nation->users as $user)
                                        @if($user->hasrole('organization'))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_main}}</td>
                                                <td>
                                                    <a href="{{route('organizations.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
            {{-- organizations end --}}

            {{-- job seekers start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-users"></i>
                            {{trans('admin.job_seekers')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nation->users as $user)
                                        @if($user->hasrole('job_seeker'))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone_main}}</td>
                                                <td>
                                                    <a href="{{route('seekers.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
            {{-- job seekers end --}}

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
                            url: "{{route('nationalities.delete')}}",
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

                                    window.location.href = "{{route('nationalities.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('nationalities.index')}}";
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