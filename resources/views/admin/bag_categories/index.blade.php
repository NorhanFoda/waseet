
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle') 
{{trans('admin.bag_categories')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    {{trans('admin.bag_categories')}}
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.bag_categories')}}
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
                            <a href="{{route('bag_categories.create')}}" class="btn btn-primary btn-block my-2 waves-effect waves-light">{{trans('admin.add')}} </a>
                            <table class="table table-bordered mb-0 dt-responsive nowrap" id="data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.name_ar')}}</th>
                                    <th>{{trans('admin.name_en')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                        <tr align="center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$cat->name_ar}}</td>
                                            <td>{{$cat->name_en}}</td>
                                            <td>
                                                <a href="{{route('bag_categories.show', $cat->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('bag_categories.edit', $cat->id)}}" class="btn" style="color:white;"><i class="fa fa-pencil-square-o"></i></a>
                                                <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$cat->id}}'
                                                    class="delete btn" style="color:red;"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
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
                            url: "{{route('bag_categories.delete')}}",
                            type: "post",
                            dataType: 'json',
                            data: {"_token": "{{ csrf_token() }}", id: id},
                            success: function(data){
                                if(data.data == 1){
                                    Swal.fire({
                                        type: 'success',
                                        title: '{{trans('admin.prodcut_deleted')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.reload();
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.product_can_not_be_deleted')}}',
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