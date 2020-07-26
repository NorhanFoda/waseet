@extends('web.layouts.app')
@section('title', trans('web.addresses'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')
      <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">مركز المساعدة</h5>
                        <p data-aos="fade-up">
                            هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحة
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
                                        aria-controls="home" aria-selected="true">الصور</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">الفيديوهات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                        aria-controls="contact" aria-selected="false">الملفات</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <!--start gallery-div-->
                                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="{{asset('web/images/book.png')}}" class="html5lightbox" data-group="set-1">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row vedio-row">
                                <!--start gallery-div-->
                                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="html5lightbox" data-group="set-2">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="html5lightbox" data-group="set-2">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="html5lightbox" data-group="set-2">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="html5lightbox" data-group="set-2">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->

                                  <!--start gallery-div-->
                                  <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="html5lightbox" data-group="set-2">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->


                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <!--start gallery-div-->
                                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in">
                                    <div class="gallery-div">
                                        <a href="#">
                                            <img src="{{asset('web/images/book.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <!--end gallery-div-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
    <script src="js/html5lightbox.js"></script>

@endsection
