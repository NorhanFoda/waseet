@extends('web.layouts.app')
@section('title', trans('web.payment_methods'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

        <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">{{trans('web.payment_methods')}}</h5>
                        {{-- <p data-aos="fade-up">
                            {{trans('web.payment_methods_text')}}
                        </p> --}}
                    </div>
                </div>
            </div>
        </section>

        <section class="profile margin-div text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{-- <h5 class="second_title second_color text-center" data-aos="fade-in">{{trans('web.banks')}}</h5> --}}

                        <div class="white-payment text-center">
                            <div class="row">

                                @foreach($payment_methods as $method)
                                <div @if(count($payment_methods) == 1) class="col-md-12" @else class="col-md-6" @endif data-aos="fade-in">
                                    <div class="payment-grid">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="{{route('payment.continue_pay', ['order_id' => $order_id, 'method_id' => $method->id])}}" class="custom-btn">{{$method->{'name_'.session('lang')} }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach


                                {{-- @foreach($banks as $bank)
                                    <div @if(count($banks) == 1) class="col-md-12" @else class="col-md-6" @endif data-aos="fade-in">
                                        <div class="payment-grid">
                                            <img src="{{asset('web/images/bank.png')}}" alt="bank">
                                                <ul class="list-inline">
                                                <li>
                                                    <span>
                                                        {{trans('web.bank_name')}} :
                                                    </span>
                                                    {{$bank->{'name_'.session('lang')} }}
                                                </li>
                                                <li>
                                                    <span>
                                                        {{trans('web.account_number')}} :
                                                    </span>
                                                    {{$bank->account_number}}
                                                </li>
                                                <li>
                                                    <span>
                                                        {{trans('web.iban')}} :
                                                    </span>
                                                    {{$bank->iban}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach --}}

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection