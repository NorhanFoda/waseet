<!DOCTYPE html>

<html>

<head>
    <title> {{trans('admin.waseet')}} </title>
    <meta charset="utf-8">
    <meta name="description" content="welcoma">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- *******************************
    **********************
    ***************
    -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('web/landing/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" href="images/.png" />

    <link rel="stylesheet" href="{{asset('web/landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/landing/css/owl.theme.default.min.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/landing/css/animate.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('web/landing/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/landing/css/responsive.css')}}">

    <link rel="stylesheet" href="{{asset('web/landing/css/ar.css')}}">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#F36649">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#F36649">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#F36649">
    <meta name="apple-mobile-web-app-capable" content="yes">
</head>












<body>





    <!-- start looding=====
    ================
    ===== -->

    <div class="looding" id="loader">
        <div class="svg_looding" >
            <object data="{{asset('web/landing/images/stroke-feather.svg')}}">
                <img src="{{asset('web/landing/images/stroke-feather.svg')}}" alt="">
            </object>
        </div>
    </div>


    <!-- end looding=====
    ================
    ===== -->




    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-3">
                    <div class="logo">
                        <a href="">
                            <img src="{{asset('web/landing/images/f1.png')}}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="element" id="menu-div">
                        <div class="logo-mune">
                            <img src="{{asset('web/landing/images/f1.png')}}" alt="">
                        </div>
                        <ul>
                            <li><a href="{{route('home')}}"> الرئيسية</a></li>
                            @isset($pages)
                                <li><a href="{{route('pages', $pages[0]->name_en)}}">من نحن</a></li>
                                <li><a href="{{route('pages', $pages[3]->name_en)}}">المميزات</a></li>
                                <li><a href="{{route('pages', $pages[0]->name_en)}}"> المزيد</a></li>
                            @endisset 

                        </ul>
                    </div>
                </div>


                
                @guest
                    <div class="col-lg-2 col-md-3">
                        <div class="link_wep">
                            <a href="{{route('login.form')}}"> دخول</a>
                        </div>
                    </div>
                @endguest


                <div class="col-lg-12">
                    <div class="center_header">
                        <div class="img_header">
                            <img src="{{asset('web/landing/images/feather-pen.png')}}" alt="">
                        </div>
                        <div class="title_header">
                            <h2> مشوارك التربوي يبدأ معنا</h2>
                            <p> لِنُعلم .. مع وسيط المعلم</p>
                        </div>

                    </div>
                </div>
            </div>



            <!-- icon-mune -->
            <div class="times" id="times-ican">
                <i class="fas fa-bars"></i>
            </div>
            <!-- -------- -->   

        </div>

    </div>




    <!-- start about_us ====
==============
====== -->
    <div class="about_us">
        <div class="container">
            <div class="row  justify-content-center">
                <!-- start sub-about_us =====
            =============-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="sub-about_us"  data-aos="fade-down">
                        <img src="{{asset('web/landing/images/rotation.png')}}" alt="">
                        <h2> الرؤية</h2>
                        <p> التميز و الإحترافية فى تقديم الخدمات للباحثين عن الوظائف التعليمية </p>
                        <div class="bg_img_about_us">
                            <img src="{{asset('web/landing/images/1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <!-- end sub-about_us =====
            =============-->

                <!-- start sub-about_us =====
            =============-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="sub-about_us "  data-aos="fade-down">
                        <img src="images/mail (9).png" alt="">
                        <h2> الرسالة </h2>
                        <p> نسعى لتقديم الخيارات المتعددة من الوظائف التعليمية عبر بوابة تقنية بمعايير عالمية لنكون الوسيط بين الباحثين عن العمل و المنشآت التعليمية للإستفادة من الخبرات و الكفاءات, كما نقوم بتقديم عدد من الحقائب التعليمية لتساعدالمعلم فى
                            تطوير مهاراتة التعليمية </p>
                        <div class="bg_img_about_us">
                            <img src="{{asset('web/landing/images//Intersection 3.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <!-- end sub-about_us =====
            =============-->


                <!-- start sub-about_us =====
            =============-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="sub-about_us"  data-aos="fade-down">
                        <img src="{{asset('web/landing/images/target (3).png')}}" alt="">
                        <h2> الأهداف</h2>
                        <p> لخلق منصة عمل لخريجات الأقسام التربوية و الإستفادة من خبراتهم التعليمية و كفائتهم</p>
                        <div class="bg_img_about_us">
                            <img src="{{asset('web/landing/images/Intersection 4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <!-- end sub-about_us =====
            =============-->

            </div>
        </div>
    </div>

    <!-- end about_us ====
==============
====== -->


    <div class="title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title_advantages">
                        <p>
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد النص العربى
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- start advantages ===
============
=====  -->
    <div class="advantages">
        <div class="container">
            <div class="row">


                <!-- start  img_advantages -->
                <div class="col-lg-12">
                    <div class="img_advantages">
                        <img src="{{asset('web/landing/images/Mask Group 4.png')}}" alt="">
                    </div>
                </div>
                <!-- end  img_advantages -->


                <div class="col-lg-6 col-md-6">
                    <div class="text_advantages"  data-aos="fade-down">
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق</p>
                    </div>
                </div>
                <div class="col-lg-6  col-md-6">
                    <div class="sub_advantages">
                        <div class="sub1_advantages"  data-aos="fade-down">
                            <div class="contenr_number">
                                <div class="circle_percent" data-percent="10">
                                    <div class="circle_inner">
                                        <div class="round_per"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text_contenr_number">
                                <h2> البحث عن عمل</h2>
                                <p>أكثر من 120 حقيبة تعليمية لتساعد المعلم فى طرح المادة التعليمية 
                                    طرق مشوقة للطلاب</p>
                            </div>
                        </div>

                        <div class="sub1_advantages "  data-aos="fade-down">
                            <div class="contenr_number">
                                <div class="circle_percent" data-percent="80">
                                    <div class="circle_inner">
                                        <div class="round_per"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text_contenr_number">
                                <h2> الحقائب التعليمية</h2>
                                <p>أكثر من 200 فرصة عمل  لتسهيل عملية البحث عن الوظائف المتاحة</p>
                            </div>
                        </div>

                        <div class="sub1_advantages"  data-aos="fade-down">
                            <div class="contenr_number">
                                <div class="circle_percent" data-percent="90">
                                    <div class="circle_inner">
                                        <div class="round_per"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text_contenr_number">
                                <h2> المعلمين الخصوصيين </h2>
                                <p>أكثر من 100 معلم خصوصي لخلق منصة عمل لخريجات الأقسام التربوية 
                                    و الإستفادة من خبراتهم التعليمية و كفائتهم</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end advantages ===
============
=====  -->





<!-- start downland_app  ===
==========
====-->
<div class="download_app">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="img-download">
                    <img src="{{asset('web/landing/images/11.png')}}" alt="">
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="text_download_app">
                     <h2>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</h2>
                     <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص لعربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص لأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق  مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص</p>
                     <div class="links_download_app">
                         <img src="{{asset('web/landing/images/Layer-1.png')}}" alt="">
                         <img src="{{asset('web/landing/images/Layer-2.png')}}" alt="">
                     </div>

                </div>
            </div>
        </div>

    </div>

</div>


<!-- end downland_app  ===
==========
====-->



<!-- start screen_apps  -->
<div class="screen_apps">
    <div class="container">
        <div class="owl-carousel owl-theme maincarousel" id="owl-demo">

            <!-- sub-slider -->
            <div class="item">
               <div class="img_screen_apps">
                   <img src="{{asset('web/landing/images/s1.png')}}" alt="">
               </div>
            </div>
            <!-- ---------- -->


            <!-- sub-slider -->
            <div class="item">
                <div class="img_screen_apps">
                    <img src="{{asset('web/landing/images/s2.png')}}" alt="">
                </div>
            </div>
            <!-- ---------- -->



            <!-- sub-slider -->
            <div class="item">
                <div class="img_screen_apps">
                    <img src="{{asset('web/landing/images/s3.png')}}" alt="">
                </div>
             </div>
             <!-- ---------- -->
 


            <!-- sub-slider -->
            <div class="item">
                <div class="img_screen_apps">
                    <img src="{{asset('web/landing/images/s4.png')}}" alt="">
                </div>
             </div>
             <!-- ---------- -->
 

          

        </div>
    </div>
</div>



<!-- start footer 
======
====-->
<div class="footer" style="background-image: url({{asset('web/landing/images/fS0iCyeBHz.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-footer">
                    <div class="logo-footer">
                        <img src="{{asset('web/landing/images/logo.png')}}" alt="">
                    </div>

                    <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                        لقد تم توليد هذا النص من مولد النص العربى</p>


                    <div class="media">
                        <ul>
                            <li>
                                <a href="{{$socials[0]->link}}"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="{{$socials[1]->link}}"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{$socials[2]->link}}"><i class="fab fa-snapchat"></i></a>
                            </li>
                            <li>
                                <a href="{{$socials[3]->link}}"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>

        </div>

        <div class="end_page">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p>جميع الحقوق محفوظة    &copy     لموقع  وسيط المعلم</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href=""> صنع بكل حب       <i class="fas fa-heart"></i>    في معامل جدارة</a>
                </div>
            </div>
        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{asset('web/landing/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('web/landing/js/wow.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{asset('web/landing/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('web/landing/js/custom.js')}}"></script>

</body>
<!-- end-body
=================== -->

</html>