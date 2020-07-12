<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{trans('admin.waseet')}} | @yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="image" content="@yield('image')" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#c1a5e3">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#c1a5e3">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#c1a5e3">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/bootstrap-theme.min.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/owl.theme.default.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css" />
  <link rel="stylesheet" href="{{asset('web/css/aos.css')}}" />
  <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('web/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/ar.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}" />
  <script src="{{asset('web/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
  <link rel="shortcut icon" href="{{asset('web/images/favicon.ico')}}" />

</head>

<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve
        your experience.
      </p>
    <![endif]-->

    @php
        $set = \App\Models\Setting::find(1);
        $pages = \App\Models\StaticPage::where('appear_in_footer', 1)->get();
        $socials = \App\Models\Social::where('appear_in_footer', 1)->get();
    @endphp


    <div class="home-pg">
        @include('web.layouts.login')

        <section class="welcome text-center">
            <div class="container">
                <div class="row">
                <div class="col-12">
                    <p class="typed"></p>
                </div>
                </div>
            </div>
        </section>

        @include('web.layouts.navbar')

        @yield('content')

    </div>

    @include('web.layouts.footer')

    <script src="{{asset('web/js/vendor/jquery-1.11.2.min.js')}}"></script>
    <script>
        window.jQuery ||
        document.write(
            '<script src="{{asset("js/vendor/jquery-1.11.2.min.js")}}"></script>'
        );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{asset('web/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('web/js/vendor/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web/js/vendor/scroll-out.js')}}"></script>
    <script src="{{asset('web/js/vendor/vanilla-tilt.min.js')}}"></script>
    <script src="{{asset('web/js/vendor/typed.js')}}"></script>
    <script src="{{asset('web/js/vendor/aos.js')}}"></script>
    <script src="{{asset('web/js/main.js')}}"></script>
    <script>
        $("#owl2").owlCarousel({
        rtl: true,
        loop: true,
        margin: 0,
        nav: false,
        items: 4,
        responsive: {
            0: {
            items: 1,
            },
            600: {
            items: 2,
            },
            1000: {
            items: 4,
            },
        },
        });
    </script>
</body>

</html>