@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.organizations')}}
@endsection

@section('content')
<div class="content-body">

    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.organizations')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.organizations')}}
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
                            {{$org->name}}
                        </div>
                        <div class="card-title">
                            {{-- {{$org->country->{'name_'.session('lang')} }} - 
                            {{$org->city->{'name_'.session('lang')} }} --}}
                            {{trans('admin.location')}}: {{$org->address}}
                            <br>
                            {{trans('admin.organization_type')}}: {{$org->edu_type_id == 4 && $org->other_edu_type != null ? $org->other_edu_type : $org->edu_type->{'name_'.session('lang')} }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="users-view-image">
                                <img src="{{$org->image ? $org->image->path : asset('images/seeding/avatar.png')}}" class="users-avatar-shadow rounded mb-2 pr-2 ml-1" 
                                alt="avatar" style="width:150px; height:150px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('organizations.edit', $org->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$org->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- announced jobs start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-bullhorn"></i>
                            {{trans('admin.announced_jobs')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.location')}}</th>
                                        <th>{{trans('admin.required_number')}}</th>
                                        <th>{{trans('admin.salary')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($org->job_announces as $job)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$job->{'name_'.session('lang')} }}</td>
                                            <td>{{$job->address}}</td>
                                            <td>{{$job->required_number}}</td>
                                            <td>{{$job->salary}} {{trans('admin.sr')}}</td>
                                            <td>
                                                <a href="{{route('jobs.show', $job->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- announced jobs end -->

            {{-- organization jobs applicants start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-users"></i>
                            {{trans('admin.job_applicants')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
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
                                    @foreach($org->org_applicants as $user)
                                        @php
                                            if(strpos($user->phone_main, ',') !== false){
                                                $arr = explode(',' , $user->phone_main);
                                                $key = $arr[0];
                                                $phone_main = $arr[1];
                                            }
                                            else{
                                                $key = '';
                                                $phone_main = $user->$phone_main;
                                            }
                                            
                                            $phone_secondary = null;
                                            $sec_key = null;
                                            if($user->phone_secondary != null && strpos($user->phone_secondary, ',') !== false){
                                                $arr2 = explode(',' , $user->phone_secondary);
                                                $sec_key = $arr2[0];
                                                $phone_secondary = $arr2[1];
                                            }
                                            else{
                                                $sec_key = '';
                                                $phone_secondary = $user->$phone_secondary;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$key}} {{$phone_main}}</td>
                                            <td>
                                                <a href="{{route('applicants.show', $user->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- organization jobs applicants end --}}

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
                            url: "{{route('organizations.delete')}}",
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

                                    window.location.href = "{{route('organizations.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('organizations.index')}}";
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