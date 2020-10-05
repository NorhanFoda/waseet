@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.job_applicants')}}
@endsection

@section('content')
<div class="content-body">

    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.job_applicants')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.job_applicants')}}
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
                            {{$applicant->name}}
                        </div>
                    </div>
                    @php
                        if(strpos($applicant->phone_main, ',') !== false){
                            $arr = explode(',' , $applicant->phone_main);
                            $key = $arr[0];
                            $phone_main = $arr[1];
                        }
                        else{
                            $key = '';
                            $phone_main = $applicant->$phone_main;
                        }
                        
                        $phone_secondary = null;
                        $sec_key = null;
                        if($applicant->phone_secondary != null && strpos($applicant->phone_secondary, ',') !== false){
                            $arr2 = explode(',' , $applicant->phone_secondary);
                            $sec_key = $arr2[0];
                            $phone_secondary = $arr2[1];
                        }
                        else{
                            $sec_key = '';
                            $phone_secondary = $applicant->$phone_secondary;
                        }
                    @endphp

                    <div class="card-body">
                        <div class="row">
                            <div class="users-view-image col-md-4">
                                <p>{{trans('admin.email')}}: {{$applicant->email }}</p>
                                <p>{{trans('admin.phone_main')}}: {{$key}} {{$phone_main }}</p>
                                <p>{{trans('admin.phone_secondary')}}: {{$sec_key}} {{$phone_secondary }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    {{trans('admin.address')}} : {{$applicant->address}}
                                </p>
                                <p>{{trans('admin.salary')}}: {{$applicant->salary_month}} {{trans('admin.sr')}}</p>
                                <p>{{trans('admin.age')}}: {{$applicant->age}} {{trans('admin.years')}}</p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{$applicant->document->path}}">
                                    <img src="{{asset('admin/images/logo/cv.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('applicants.edit', $applicant->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$applicant->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            {{-- jobs start --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-bullhorn"></i>
                            {{trans('admin.jobs')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.country')}}</th>
                                        <th>{{trans('admin.announcer')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applicant->job_applications as $job)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$job->{'name_'.session('lang')} }}</td>
                                            <td>{{$job->address}}</td>
                                            <td>{{$job->announcer->name}}</td>
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
            {{-- jobs end --}}

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
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.phone_main')}}</th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.location')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applicant->job_organizations as $org)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$org->name}}</td>
                                            <td>{{$org->phone_main}}</td>
                                            <td>{{$org->email}}</td>
                                            <td>{{$org->address}}</td>
                                            <td>
                                                <a href="{{route('organizations.show', $org->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- organizations end --}}

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
                            url: "{{route('applicants.delete')}}",
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

                                    window.location.href = "{{route('applicants.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('applicants.index')}}";
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