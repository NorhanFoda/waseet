@extends('web.layouts.register')
@section('title', trans('web.register'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')
<div class="background"></div>

    <div class="cardBody">
        <div class="goSignUp" data-aos="fade-in">
            <div class="logo">
                <img src="{{asset('web/images/Vector-Smart-Object2.png')}}" alt="" />
            </div>

            <div class="welcome">
                <p>
                    {{$welcome_text}}
                </p>
            </div>

            <div class="login-btn">
                <form action="{{route('register.resend_code')}}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{$email}}" />
                    <button type="submit" id="resend_code" class="white-btn">{{trans('web.resend_code')}}</button>
                </form>
            </div>

        </div>

        <div class="logIn" data-aos="fade-in">
            <form action="{{route('register.verify')}}" method="POST" id="logIn">
                @csrf
                <h5>{{trans('web.verify_code')}}</h5>

                <div class="inputs-contain">
                    <div class="userName">
                        <input type="number" id="mail" name="code" required />
                        <label for="mail">
                            {{trans('web.code')}} 
                        </label>
                        <input type="hidden" name="email" value="{{$email}}" />
                    </div>

                </div>

                <div class="submit">
                    <button type="submit" class="custom-btn">{{trans('web.verify')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#resend_code').click(function(){
                $.ajax({
                    url: "{{route('register.resend_code')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", email: '{{$email}}' },
                    success: function(data){
                        Swal.fire({
                            title: "{{trans('web.verification_code_sent')}}",
                            type: 'success',
                            timer: 1500,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            })
        });
    </script>
@endsection