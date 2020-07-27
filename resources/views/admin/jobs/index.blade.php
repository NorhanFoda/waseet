
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle') 
{{trans('admin.jobs')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    {{trans('admin.jobs')}}
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.jobs')}}
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
                            <a href="{{route('jobs.create')}}" class="btn btn-primary btn-block my-2 waves-effect waves-light">{{trans('admin.add')}} </a>
                            <table class="table table-bordered mb-0 dt-responsive nowrap" id="data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.exper_years')}}</th>
                                    <th>{{trans('admin.free_places')}}</th>
                                    <th>{{trans('admin.salary')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                        <tr align="center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$job->{'name_'.session('lang')} }}</td>
                                            <td>{{$job->exper_years}}</td>
                                            <td>{{$job->free_places}}</td>
                                            <td>{{$job->salary}}</td>
                                            <td>
                                                <select name="approved" class="approved form-control" data-id="{{$job->id}}">
                                                    <option value="{{0}}" @if($job->approved == 0) selected @endif>{{trans('admin.refuse')}}</option>
                                                    <option value="{{1}}" @if($job->approved == 1) selected @endif>{{trans('admin.approve')}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{route('jobs.show', $job->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('jobs.edit', $job->id)}}" class="btn" style="color:white;"><i class="fa fa-pencil-square-o"></i></a>
                                                <a title="delete" onclick="return true;" id="confirm-color" object_id='{{$job->id}}'
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
                            url: "{{route('jobs.delete')}}",
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

        $(document).on('change', '.approved', function(){
            var id = $(this).data('id');
            var approved = $(this).val();

            $.ajax({
                url: "{{route('jobs.update_status')}}",
                type: "POST",
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}", id: id, approved: approved },
                success: function(data){
                    Swal.fire({
                        title: "{{trans('admin.updated')}}",
                        type: 'success',
                        timer: 1500,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        });

    </script>

@endsection
