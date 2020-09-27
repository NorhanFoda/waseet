@extends('web.layouts.app')
@section('title', trans('web.contact_us'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <div class="home">

        <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">{{trans('web.contact_us_nav')}}</h5>
                        <p data-aos="fade-up">{{trans('web.contact_us')}}</p>
                    </div>
                </div>
            </div>
        </section>
    
        <section class="contactUs_form">
            <div class="contactInfo">
                <div class="overlay"></div>
                <h5>{{trans('web.contact_us')}}</h5>
                <div class="info">
                    <div class="phone" data-aos="fade-in">
                        <span><i class="fas fa-phone"></i></span>
                        <a href="tel:{{$set->phone}}">{{$set->phone}}</a>
                    </div>    
                    <div class="mail"  data-aos="fade-in">
                        <span><i class="fas fa-envelope"></i></span>
                        <a href="mailto:{{$set->email}}">{{$set->email}}</a>
                    </div>
                    <div class="address"  data-aos="fade-in">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <a href="#">{{$set->{'location_'.session('lang')} }}</a>
                    </div>
                </div>
                <div class="social">
                    <a href="{{$socials[0]->link}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$socials[1]->link}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{$socials[2]->link}}"><i class="fab fa-snapchat"></i></a>
                    <a href="{{$socials[3]->link}}" ><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <form action="{{route('contact_us.store')}}" method="POST">
                @csrf
                <div class="inputs-contain">
                    <h5  data-aos="fade-in">{{trans('web.send_us_message')}}</h5>
                    <div class="email"  data-aos="fade-in">
                        <input type="text" name="name" id="mail" required />
                        <label for="mail">
                            <img src="{{asset('web/images/user.png')}}" alt="" /> {{trans('web.name')}}
                        </label>
                    </div>
                    <div class="password"  data-aos="fade-in">
                        <input type="email" name="email" id="email" required />
                        <label for="email">
                            <img src="{{asset('web/images/email.png')}}" alt="" /> {{trans('web.email')}} 
                        </label>
                    </div>
                    <div class="msg"  data-aos="fade-in">
                        <input type="text" name="message" id="msg" required />
                        <label for="msg">
                            <img src="{{asset('web/images/comment.png')}}" alt="" />   {{trans('web.write_message_here')}}
                        </label>
                    </div>
                    <div class="submit"  data-aos="fade-in">
                        <button type="submit">{{trans('web.send')}}</button>
                    </div>
                </div>
            </form>
        </section>

    </div>

@endsection