
@extends('admin.layouts.app')

@section('pageTitle')
{{trans('admin.waseet')}}
@endsection

@section('pageSubTitle') 
{{trans('admin.orders')}}
@endsection

@section('content')

    <!--start div-->

    <div class="row" style="display:block">


        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    {{trans('admin.orders')}}
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">{{trans('admin.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('admin.orders')}}
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
                            <table class="table table-bordered mb-0 dt-responsive nowrap data_table">
                                <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>{{trans('admin.order_id')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.total_price')}}</th>
                                    <th>{{trans('admin.address')}}</th>
                                    <th>{{trans('admin.buy_type')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr align="center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->user->email}}</td>
                                            <td>{{$order->total_price + $order->shipping_fees}} {{trans('admin.sr')}}</td>
                                            <td>{{$order->buy_type == 1 ? trans('web.buy_online') : trans('web.print_content')}}</td>
                                            {{--<td>{{$order->address->country->{'name_'.session('lang')} }} - 
                                                {{$order->address->city->{'name_'.session('lang')} }} - 
                                                {{$order->address->address}} - 
                                                {{trans('web.ps')}} : {{$order->address->postal_code}}
                                            </td>--}}
                                            @if($order->address == null)
                                                {{dd($order->id)}}
                                            @endif
                                            <td>{{$order->address->address}}</td>
                                            <td>
                                                <select name="status" class="form-control status" data-id="{{$order->id}}">
                                                    <option value="{{2}}" @if($order->status == 2) selected @endif>{{trans('admin.waiting')}}</option>
                                                    <option value="{{3}}" @if($order->status == 3) selected @endif>{{trans('admin.shipping')}}</option>
                                                    <option value="{{4}}" @if($order->status == 4) selected @endif>{{trans('admin.delivered')}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{route('orders.show', $order->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
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
       // change order status
       $(document).ready(function(){
           $('.status').change(function(){
                var id = $(this).data('id');
                var status = $(this).val();
                
                $.ajax({
                    url: "{{route('orders.update')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", id: id, status: status },
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
       });
    </script>

@endsection
