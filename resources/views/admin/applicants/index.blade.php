
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle') 
{{trans('admin.job_applicants')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


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


        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <a href="{{route('applicants.create')}}" class="btn btn-primary btn-block my-2 waves-effect waves-light">{{trans('admin.add')}} </a>
                            <table class="table table-bordered mb-0 dt-responsive nowrap data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.phone_main')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($applicants as $app)
                                        @if($app->job_applications_count > 0)
                                            @php
                                                if(strpos($app->phone_main, ',') !== false){
                                                    $arr = explode(',' , $app->phone_main);
                                                    $key = $arr[0];
                                                    $phone_main = $arr[1];
                                                }
                                                else{
                                                    $key = '';
                                                    $phone_main = $app->$phone_main;
                                                }
                                            @endphp
                                            <tr align="center">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$app->name}}</td>
                                                <td>{{$key}} {{$phone_main}}</td>
                                                <td>{{$app->email}}</td>
                                                <td>
                                                    <a href="{{route('applicants.show', $app->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('applicants.edit', $app->id)}}" class="btn" style="color:white;"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$app->id}}'
                                                        class="delete btn" style="color:red;"><i class="fa fa-trash-o"></i></a>
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
    </div>
    </div>
    <!--end div-->

@endsection

@section('scripts')
    <script>
        //delete categories
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

                                    window.location.reload();
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.reload();
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
