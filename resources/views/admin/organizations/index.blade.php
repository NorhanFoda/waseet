
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle') 
{{trans('admin.organizations')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


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


        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <a href="{{route('organizations.create')}}" class="btn btn-primary btn-block my-2 waves-effect waves-light">{{trans('admin.add')}} </a>
                            <table class="table table-bordered mb-0 dt-responsive nowrap data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.phone_main')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.location')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations as $org)
                                        @if(!$org->hasRole('admin'))
                                            @php
                                                if(strpos($org->phone_main, ',') !== false){
                                                    $arr = explode(',' , $org->phone_main);
                                                    $key = $arr[0];
                                                    $phone_main = $arr[1];
                                                }
                                                else{
                                                    $key = '';
                                                    $phone_main = $org->$phone_main;
                                                }
                                                
                                                $phone_secondary = null;
                                                $sec_key = null;
                                                if($org->phone_secondary != null && strpos($org->phone_secondary, ',') !== false){
                                                    $arr2 = explode(',' , $org->phone_secondary);
                                                    $sec_key = $arr2[0];
                                                    $phone_secondary = $arr2[1];
                                                }
                                                else{
                                                    $sec_key = '';
                                                    $phone_secondary = $org->$phone_secondary;
                                                }
                                            @endphp
                                            <tr align="center">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$org->name}}</td>
                                                <td>{{$key}} {{$phone_main}}</td>
                                                <td>{{$org->email}}</td>
                                                <td>{{$org->address}}</td>
                                                <td>
                                                    <a href="{{route('organizations.show', $org->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('organizations.edit', $org->id)}}" class="btn" style="color:white;"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$org->id}}'
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
