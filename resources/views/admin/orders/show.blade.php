@extends('admin.layouts.app')

@section('pageTitle')
    {{trans('admin.waseet')}}
@endsection

@section('pageSubTitle')
    {{trans('admin.orders')}}
@endsection

@section('content')
<div class="content-body">

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

    <!-- page users view start -->
    <section class="page-users-view">
        <div class="row">
            <!-- account start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                           {{trans('admin.order_id')}} : {{$order->id}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.email')}}</td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$order->user->email}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.address')}}</td>
                                        {{--<td style='margin: 5px; padding: 15px;'>
                                            {{$order->address->country->{'name_'.session('lang')} }} - 
                                            {{$order->address->city->{'name_'.session('lang')} }} -
                                            {{$order->address->address}} - {{trans('web.ps')}} : {{$order->address->postal_code}}
                                        </td>--}}
                                        <td>{{$order->address && $order->buy_type == 2 ? $order->address->address : trans('web.buy_online')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.payment_way')}}</td>
                                        <td>{{$order->payment_method ? $order->payment_method->{'name_'.session('lang')} : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.status')}}</td>
                                        <td>
                                            <select name="status" class="form-control status" data-id="{{$order->id}}">
                                                <option value="{{2}}" @if($order->status == 2) selected @endif>{{trans('admin.waiting')}}</option>
                                                <option value="{{3}}" @if($order->status == 3) selected @endif>{{trans('admin.shipping')}}</option>
                                                <option value="{{4}}" @if($order->status == 4) selected @endif>{{trans('admin.delivered')}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.price')}} : </td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$order->total_price}} {{trans('admin.sr')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.shipping_fees')}} : </td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$order->shipping_fees}} {{trans('admin.sr')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{trans('admin.total_price')}} : </td>
                                        <td style='margin: 5px; padding: 15px;'>
                                            {{$order->total_price + $order->shipping_fees}} {{trans('admin.sr')}}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                                @if($order->payment_method_id == 2)
                                    <a href="{{$order->receipt && $order->receipt->image ? $order->receipt->image->path : '#'}}">
                                        <img src="{{$order->receipt && $order->receipt->image ? $order->receipt->image->path : asset('images/seeding/avatar.png')}}" alt="{{$order->id}}" width="200px" height="200px">
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- account end -->

            <!-- bags start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2">
                            <i class="fa fa-briefcase"></i>
                            {{trans('admin.bags')}}
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <div class="table-responsive users-view-permission">
                            <table class="table table-borderless dt-responsive nowrap data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name_ar')}}</th>
                                        <th>{{trans('admin.name_en')}}</th>
                                        <th>{{trans('admin.price')}}</th>
                                        <th>{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->bags as $bag)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$bag->name_ar}}</td>
                                            <td>{{$bag->name_en}}</td>
                                            <td>
                                                {{$bag->price}} {{trans('admin.sr')}}
                                            </td>
                                            <td>
                                                <a href="{{route('bags.show', $bag->id)}}" class="btn" style="color:white;"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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