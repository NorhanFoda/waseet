
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
{{trans('admin.announces')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    {{trans('admin.announces')}}
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.announces')}}
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
                            <a href="{{route('announces.create')}}" class="btn btn-primary btn-block my-2 waves-effect waves-light">{{trans('admin.add')}} </a>
                            <table class="table table-bordered mb-0 dt-responsive nowrap" id="data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.image')}}</th>
                                    <th>{{trans('admin.appear_in_home')}}</th>
                                    <th>{{trans('admin.location')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($announces) > 0)
                                        @foreach($announces as $announce)
                                            <tr align="center">
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{$announce->image ? $announce->image->path : asset('images/seeding/avatar.png')}}" width="150px" height="150px" style="border-radius: 5px" alt="announce">
                                                </td>
                                                <td>
                                                    {{$announce->appear_in_home == 0 ? trans('admin.no') : trans('admin.yes')}}
                                                </td>
                                                <td><a href="{{$announce->link}}">{{$announce->link}}</a></td>
                                                <td>
                                                    <a href="{{route('announces.edit', $announce->id)}}" class="btn" style="color:white;"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$announce->id}}'
                                                        class="delete btn" style="color:red;"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        {{trans('admin.no_data_registred')}}
                                    @endif
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
                            url: "{{route('announces.delete')}}",
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
                                else{
                                    Swal.fire({
                                        type: 'failed',
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
                        timer: 1000
                    });
                }
            })
        });
    </script>

@endsection
