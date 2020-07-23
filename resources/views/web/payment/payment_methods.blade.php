@extends('web.layouts.app')
@section('title', trans('web.banks'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

        <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">{{trans('web.banks')}}</h5>
                        <p data-aos="fade-up">
                            {{trans('web.bank_payment_text')}}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile margin-div text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="second_title second_color text-center" data-aos="fade-in">{{trans('web.banks')}}</h5>

                        <div class="white-payment text-center">
                            <div class="row">

                                @foreach($banks as $bank)
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
                                @endforeach

                                {{-- <div class="form-group col-12 text-center" data-aos="fade-in">
                                    <br>
                                        <a href="#"  class="custom-btn">متابعة الدفع</a>
                                </div> --}}
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection