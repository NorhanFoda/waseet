@extends('web.layouts.app')
@section('title', trans('web.profile'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')
    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.profile')}}</h5>
                    <p data-aos="fade-up">{{trans('web.profile_text')}}</p>
                </div>
            </div>
        </div>
    </section>

  <section class="profile margin-div text-right-dir">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="second_title second_color text-center">{{trans('web.profile')}} </h5>
                <div class="gray-bg">
                    <div class="profile-image">
                        <img src="{{auth()->user()->image ? auth()->user()->image->path : asset('web/images/user2.png')}}" alt="user">
                        <div class="side-prof">
                            <h3 class="first_color">{{auth()->user()->name}}</h3>
                            <span class="second_color">{{auth()->user()->email}}</span>
                        </div>
                        <a href="{{route('profile.edit_personal_info')}}" class="circle-shape"><img src="{{asset('web/images/pencil.png')}}" alt="pencil"></a>
                    </div>

                    <!--start edit-list-->
                    <div class="prof-edit-list">
                        <ul class="list-unstyled arrow-list">
                            {{-- <li><a href="{{route('profile.edit_personal_info')}}"><i class="fa fa-user"></i>{{trans('web.personal_info')}}</a></li> --}}
                            @if(auth()->user()->hasRole('job_seeker'))
                                <li><a href="cv.html"><i class="fa fa-file"></i>{{trans('web.cv')}}</a></li>
                            @endif
                            <li><a href="{{route('saved.index')}}"><i class="fa fa-bookmark"></i>{{trans('web.saved')}}</a></li>
                            <li><a href="orders.html"><i class="fa fa-list-alt"></i>{{trans('web.orders')}}</a></li>
                            <li><a href="{{route('addresses.index')}}"><i class="fa fa-map-marker-alt"></i>{{trans('web.shipping_addresses')}}</a></li>
                            <li><a href="{{route('carts.index')}}"><i class="fa fa-shopping-cart"></i>{{trans('web.cart')}}</a></li>
                            <li><a href="helpCenter.html"><i class="fa fa-question-circle"></i>{{trans('web.help_center')}}</a></li>
                        </ul>
                    </div>
                    <!--end edit-->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection