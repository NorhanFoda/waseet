@extends('web.layouts.app')
@section('title', trans('web.contents_of_bag'))
@section('description', \App::getLocale() == 'ar' ? $bag->description_ar : $bag->description_en)
@section('image', asset('/images/logo.png'))

@section('content')
      <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">{{trans('web.contents_of_bag')}}</h5>
                        <p data-aos="fade-up">
                            {{trans('web.contents_text')}}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="aboutus_wrapper text-center" data-aos="fade-in">
            <div class="container">
                <div class="tabs-div">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">{{trans('web.images')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">{{trans('web.videos')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                        aria-controls="contact" aria-selected="false">{{trans('web.documents')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">

                                <!--start gallery-div-->
                                @foreach($bag->images as $image)
                                    @if($image->image_type == 'content')
                                        <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                            <div class="gallery-div">
                                                <a href="{{$image->path}}" class="html5lightbox" data-group="set-1">
                                                    <img src="{{$image->path}}" alt="img">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <!--end gallery-div-->

                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row vedio-row">

                                <!--start gallery-div-->
                                @foreach($bag->videos as $video)
                                    <div class="col-lg-3 col-md-4 col-6" data-ao="fade-in">
                                        <div class="gallery-div">
                                            <a href="{{$video->path}}" class="html5lightbox" data-group="set-2">
                                                <img src="{{$bag->poster}}" alt="img">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <!--end gallery-div-->

                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <!--start gallery-div-->
                                @foreach($bag->documents as $pdf)
                                    <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                        <div class="gallery-div">
                                            <a href="{{$pdf->path}}">
                                                <img src="{{asset('web/images/book.png')}}" alt="img">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <!--end gallery-div-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
    <script src="js/html5lightbox.js"></script>

@endsection
