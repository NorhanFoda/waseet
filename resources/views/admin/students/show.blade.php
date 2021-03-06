@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.students')}}
@endsection

@section('content')
<div class="content-body">

    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
                {{trans('admin.students')}}
            </h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('admin.students')}}
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
                            {{$std->name}}
                        </div>
                    </div>
                    @php
                        if(strpos($std->phone_main, ',') !== false){
                            $arr = explode(',' , $std->phone_main);
                            $key = $arr[0];
                            $phone_main = $arr[1];
                        }
                        else{
                            $key = '';
                            $phone_main = $std->$phone_main;
                        }

                        $phone_secondary = null;
                        $sec_key = null;
                        if($std->phone_secondary != null && strpos($std->phone_secondary, ',') !== false){
                            $arr2 = explode(',' , $std->phone_secondary);
                            $sec_key = $arr2[0];
                            $phone_secondary = $arr2[1];
                        }
                        else{
                            $sec_key = '';
                            $phone_secondary = $std->$phone_secondary;
                        }

                    @endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="users-view-image col-md-4">
                                <p>{{trans('admin.email')}}: {{$std->email }}</p>
                                <p>{{trans('admin.phone_main')}}: {{$key}} {{$phone_main }}</p>
                                <p>{{trans('admin.phone_secondary')}}: {{$sec_key}} {{$phone_secondary }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    @if($std->stage_id == 4 && $std->other_stage != null)
                                        {{$std->other_stage}}
                                    @else
                                        @if($std->stage)
                                            {{$std->stage->{'name_'.session('lang')} }}
                                        @else
                                            {{'-'}}
                                        @endif

                                    @endif
                                </p>
                                <p>{{trans('admin.age')}}: {{$std->age}} {{trans('admin.years')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('students.edit', $std->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i>{{trans('admin.edit')}}</a>
                            <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$std->id}}'
                                class="delete btn btn-outline-danger" style="color:white;"><i class="feather icon-trash-2"></i>{{trans('admin.delete')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

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
                            url: "{{route('students.delete')}}",
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

                                    window.location.href = "{{route('students.index')}}";
                                }
                                else if(data.data == 0){
                                    Swal.fire({
                                        type: 'error',
                                        title: '{{trans('admin.error')}}',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    window.location.href = "{{route('students.index')}}";
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
