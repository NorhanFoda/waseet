<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    @yield('meta')

  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('web/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/ar.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}" />
  <script src="{{asset('web/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
  <link rel="shortcut icon" href="{{asset('web/images/favicon.ico')}}" />

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=58b550fc949fce00118ce697&product=inline-share-buttons"></script>

</head>

<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve
        your experience.
      </p>
    <![endif]-->

    <div class="home-pg">

        <!--<section class="welcome text-center">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--        <div class="col-12">-->
        <!--            <p class="typed"></p>-->
        <!--        </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

        @include('web.layouts.navbar')

        @yield('content')

    </div>

    @include('web.layouts.footer')

    <script src="{{asset('web/js/vendor/jquery-1.11.2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{asset('web/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('web/js/vendor/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web/js/vendor/scroll-out.js')}}"></script>
    <script src="{{asset('web/js/vendor/vanilla-tilt.min.js')}}"></script>
    <!--<script src="{{asset('web/js/vendor/typed.js')}}"></script>-->
    <script src="{{asset('web/js/vendor/aos.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

    <!--Floating WhatsApp css-->
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
    <!--Floating WhatsApp javascript-->
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script> 
    <script type="text/javascript">
        $(function () {
        $('#WAButton').floatingWhatsApp({
            phone: 01009160863, //WhatsApp Business phone number International format-
            //Get it with Toky at https://toky.co/en/features/whatsapp.
            headerTitle: "whats app header",
            popupMessage: "whats app message",
            showPopup: true, //Enables popup display
            buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
            //headerColor: 'crimson', //Custom header color
            //backgroundColor: 'crimson', //Custom background button color
            position: "right",
            size: 60
        });
        });
    </script>
    <!--End of Tawk.to Script--> 

    <script src="{{asset('web/js/main.js')}}"></script>

    {{-- GOOGLE MAPS START --}}
    {{-- <script src="{{asset('web/js/map/map.js')}}"></script> --}}
    {{-- GOOGLE MAPS END --}}

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

        // Welcome text
        // $(document).ready(function () {
        //     console.log();
        //     var typed = new Typed(".typed", {
        //     strings: [" ^1500"+'{{$set->{"welcome_text_".session("lang") } }}'],
        //     smartBackspace: true, // Default value
        //     typeSpeed: 50,
        //     backSpeed: 20,
        //     loop: true,
        //     });

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        // });

    </script>

    @yield('scripts')

    <script>
        $(document).ready(function(){
            // Save posts
            $('#bookmark').click(function(){
                if(!'{{Auth::check()}}'){
                    Swal.fire({
                        title: "{{trans('web.do_login_2')}}",
                        type: 'warning',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
                else{
                    $.ajax({
                        url: "{{route('save')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", id: $(this).data('id'), type: $(this).data('type') },
                        success: function(data){
                        Swal.fire({
                            title: data['msg'],
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                        }
                    });
                }
            });

            // Rate posts
            $('.rate').click(function(){
                if(!'{{Auth::check()}}'){
                    Swal.fire({
                        title: "{{trans('web.do_login_2')}}",
                        type: 'warning',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
                else{
                    $.ajax({
                        url: "{{route('rate')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", id: $(this).data('id'), type: $(this).data('type'), rate: $(this).val() },
                        success: function(data){
                        Swal.fire({
                            title: data['msg'],
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                        }
                    });
                }
            });
        });
    </script>

    {{--remove-alert--}}
    <script>
        $(document).on('click', '.remove-alert', function (e) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: '{{trans('sweet_alert.title')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{trans('sweet_alert.yes')}}',
                cancelButtonText: '{{trans('sweet_alert.no')}}',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    var id = $(this).attr('object_id');
                    var d_url = $(this).attr('delete_url');
                    var elem = $(this).parent('td').parent('tr');
                    var proelem =$(this).closest(".remove-oneitem"),
                        token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'post',
                        url: '/admin'+d_url+id,
                        data: {
                            _method:'delete',
                            _token: token
                        } ,
                        dataType: 'json',
                        success: function (result) {
                            console.log('result', result);
                            elem.remove();
                            proelem.remove();
                            swalWithBootstrapButtons.fire({
                                title: '{{trans('sweet_alert.deleted_successfully')}}',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                } else if (
                    // / Read more about handling dismissals below /
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: '{{trans('sweet_alert.cancelled')}}',
                        showConfirmButton: false,
                        timer: 1000
                    });

                }
            })
        });
    </script>

    @if(session()->has('success'))
        <script>
            Swal.fire({
                title: "{{ session()->get('success')}}",
                type: 'success',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
            });
            '{{session()->forget("success")}}';
        </script>
    @endif

    @if(session()->has('error'))
        <script>
            Swal.fire({
                title: "{{ session()->get('error')}}",
                type: 'error',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
            });
            '{{session()->forget("error")}}';
        </script>
    @endif

    @if(session()->has('warning'))
        <script>
            Swal.fire({
                title: "{{ session()->get('warning')}}",
                type: 'warning',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
            });
            '{{session()->forget("warning")}}';
        </script>
    @endif

    @foreach($errors->all() as $error)
        <script> 
            Swal.fire({
                title: "{{ $error }}",
                type: 'error',
                timer: 1500,
                showCancelButton: false,
                showConfirmButton: false,
            });
        </script>
    @endforeach
</body>

</html>