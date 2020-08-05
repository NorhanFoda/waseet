@extends('web.layouts.app')
@section('title', trans('web.banks'))
@section('description', trans('web.waseet description'))
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

        <section class="profile margin-div text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="signUp gray-form  gray-bg" data-aos="fade-in">
                            <form action="{{route('payment.bank_receipt')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="inputs-contain">

                                    <input type="hidden" name="order_id" value="{{$order_id}}">
                                    <div class="userName">
                                        <input type="text" name="name" required>
                                        <label>
                                            <i class="fa fa-user"></i>{{trans('web.full_name')}} 
                                        </label>
                                    </div>

                                    <div class="userName">
                                        <input type="email" name="email" required>
                                        <label>
                                            <i class="fa fa-envelope"></i>{{trans('web.email')}} 
                                        </label>
                                    </div>

                                    <div class="userName">
                                        <input type="tel" name="phone" minlength="9" maxlength="11" required>
                                        <label>
                                            <i class="fa fa-phone"></i> {{trans('web.phone')}}
                                        </label>
                                    </div>

                                    <div class="userName custom-select2">
                                        <select class="custom-input" name="bank_id" required>
                                            <option selected disabled value="{{null}}">{{trans('web.bank_name')}}</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-icon">
                                            <i class="fa fa-university"></i>
                                        </span>
                                    </div>

                                    <div class="userName">
                                        <input type="number" name="cost" min="1" required>
                                        <label>
                                            <i class="fa fa-money-bill-wave-alt"></i> {{trans('web.cost')}}
                                        </label>
                                    </div>

                                    <div class="userName custom-file right-custom-file">
                                        <input type="file" id="file-up" name="image" accept=".gif, .jpg, .png, .webp" required>
                                        <label for="file-up">
                                            <i class="fa fa-upload"></i> <span>{{trans('web.receipt')}}</span>
                                        </label>
                                    </div>

                                    <div class="userName">
                                        <textarea style="min-height: 100px;"></textarea>
                                        <label>
                                            <i class="fa fa-file"></i>{{trans('web.additional_details')}}
                                        </label>
                                    </div>

                                    <div class="userName img-show">
                                        <img src="" class="file-upload-image" alt="">
                                    </div>

                                    <button type="submit" class="custom-btn">{{trans('web.send')}}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
@endsection

@section('scripts')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.file-upload-image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0])

            }
        }
        $(".custom-file input").change(function () {
            var self = $(this).val().replace(/C:\\fakepath\\/i, '');
            $(this).next("label").find("span").text(self);
             $(".img-show").fadeIn();
            readURL(this)
        });
    </script>

@endsection