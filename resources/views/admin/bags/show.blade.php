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
                                <img src="{{$bag->image ? $bag->image->path : 'images/product-avatar.png'}}" class="users-avatar-shadow rounded mb-2 pr-2 ml-1" 
                                alt="avatar" style="width:150px; height:150px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('bags.edit', $bag->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$bag->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- rating start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-star-half-o"></i>
                            {{trans('admin.rating')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap" id="data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.user')}}</th>
                                        <th>{{trans('admin.rating')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($bags as $bag)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                @if(\App()->getLocale()=='ar')
                                                    {{$bag->name_ar}}
                                                @else
                                                    {{$bag->name_en}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$bag->price}} {{trans('admin.sr')}}
                                            </td>
                                            <td>
                                                <a href="{{route('bags.show', $pro->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bags end -->

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
                            url: "{{route('bag_categories.delete')}}",
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

                                    window.location.href = "{{route('bag_categories.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.category_can_not_be_deleted')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('bag_categories.index')}}";
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