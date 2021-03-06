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
  <link rel="stylesheet" href="{{asset('web/css/intlTelInput.min.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/ar.css')}}" />
  <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}" />
  <script src="{{asset('web/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
  <link rel="shortcut icon" href="{{asset('web/images/favicon.ico')}}" />

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJZeYDmZKwcHVaO9APCWP_04lYzaNK0o4&libraries=places,geometry&sensor=false&callback=initMap&language={{ \App::getLocale() }}" defer></script>

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
    <script src="{{asset('web/js/vendor/intlTelInput.min.js')}}"></script>
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
    @if(\Request::route()->getName() == 'profile.edit_personal_info')
        @if(Auth::user()->hasRole('direct_teacher') || Auth::user()->hasRole('online_teacher') ||
            Auth::user()->hasRole('organization') || Auth::user()->hasRole('job_seeker'))
            <script>
                // Initiat google map
                function initMap(){
                    
                    //   var lat = localStorage.getItem('lat') ? localStorage.getItem('lat') : 23.885942;
                    //   var lng = localStorage.getItem('lng') ? localStorage.getItem('lng') : 45.079163;

                    var lat = $('#location_lat').val();
                    var lng = $('#location_lng').val();

                    var lat2 = $('#location_lat2').val();
                    var lng2 = $('#location_lng2').val();

                    // Center the map to user current location
                    const map = new google.maps.Map(document.getElementById("gmap"), {
                        zoom: 10,
                        center: { lat: parseFloat(lat), lng: parseFloat(lng) } // Current user location or SA.
                    });

                    // Create the search box and link it to the UI element.
                    const input = document.getElementById("pac-input");

                    // prevent form submit on click (enter btn)
                    google.maps.event.addDomListener(input, 'keydown', function(event) { if (event.keyCode === 13) { event.preventDefault(); } }); 
            
                    const searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                    const teaching_input = document.getElementById("teaching-pac-input");
                    const teaching_searchBox = new google.maps.places.SearchBox(teaching_input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(teaching_input);

                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener("bounds_changed", () => {
                        searchBox.setBounds(map.getBounds());
                    });

                    map.addListener("bounds_changed", () => {
                        teaching_searchBox.setBounds(map.getBounds());
                    });

                    let markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener("places_changed", () => {
                        const places = searchBox.getPlaces();

                        if (places.length == 0) {
                        return;
                        }
                        // Clear out the old markers.
                        markers.forEach((marker) => {
                        marker.setMap(null);
                        });
                        markers = [];
                        // For each place, get the icon, name and location.
                        const bounds = new google.maps.LatLngBounds();
                        places.forEach((place) => {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        const icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25),
                        };
                        // Create a marker for each place.
                        markers.push(
                            new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                            })
                        );

                        $(document).find('#location_lat').val(place.geometry.location.lat());
                        $(document).find('#location_lng').val(place.geometry.location.lng());

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        });
                        map.fitBounds(bounds);

                    });

                    teaching_searchBox.addListener("places_changed", () => {
                        const places = teaching_searchBox.getPlaces();

                        if (places.length == 0) {
                        return;
                        }
                        // Clear out the old markers.
                        markers.forEach((marker) => {
                        marker.setMap(null);
                        });
                        markers = [];
                        // For each place, get the icon, name and location.
                        const teaching_bounds = new google.maps.LatLngBounds();
                        places.forEach((place) => {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        const icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25),
                        };
                        // Create a marker for each place.
                        markers.push(
                            new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                            })
                        );

                        $(document).find('#location_lat2').val(place.geometry.location.lat());
                        $(document).find('#location_lng2').val(place.geometry.location.lng());

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            teaching_bounds.union(place.geometry.viewport);
                        } else {
                            teaching_bounds.extend(place.geometry.location);
                        }
                        });
                        map.fitBounds(teaching_bounds);

                    });

                    // Add address marker on map
                    var address_marker = new google.maps.Marker({
                        position:  { lat:parseFloat(lat), lng: parseFloat(lng) },
                        draggable: true,
                        title:"Address Location"
                    });

                    // add info window for address marker
                    var infowindow = new google.maps.InfoWindow();  
                    google.maps.event.addListener(address_marker, 'mouseover', (function(marker) {  
                        return function() {  
                            var content = "<div>Residence Address</div>"; 
                            infowindow.setContent(content);  
                            infowindow.open(map, marker);  
                        }  
                    })(address_marker));  

                    // add tesching address marker on map
                    var teaching_marker = new google.maps.Marker({
                        position:  { lat: parseFloat(lat2), lng: parseFloat(lng2) },
                        draggable: true,
                        title:"Teaching Address Location"
                    });

                    // add info window for teaching address marker
                    var infowindow = new google.maps.InfoWindow();  
                    google.maps.event.addListener(teaching_marker, 'mouseover', (function(marker) {  
                        return function() {  
                            var content = "<div>Teaching Address</div>"; 
                            infowindow.setContent(content);  
                            infowindow.open(map, marker);  
                        }  
                    })(teaching_marker));  

                    // To add the marker to the map, call setMap();
                    address_marker.setMap(map);

                    if($('#location_lat2').length > 0){
                        teaching_marker.setMap(map);
                    }

                    // Add event listner to address_marker
                    google.maps.event.addListener(address_marker, 'dragend', function() {
                        geocodePosition(address_marker.getPosition());
                    });
                    
                    // Add event listner to teaching_address_marker
                    google.maps.event.addListener(teaching_marker, 'dragend', function() {
                        geocodePosition2(teaching_marker.getPosition()); 
                    });
                }

                function geocodePosition(pos) {

                    // Add lat and lng values to html hidden inputs
                    $('#location_lat').val(pos.lat);
                    $('#location_lng').val(pos.lat);

                    // Store lat and lng values to LocalStorage
                    localStorage.setItem('lat', pos.lat);
                    localStorage.setItem('lng', pos.lng);

                    var geocoder = new google.maps.Geocoder;
                    geocoder.geocode({
                        latLng: pos
                    }, function(responses) {
                        if (responses && responses.length > 0) { 
                        updateMarkerAddress(responses[0].formatted_address);
                        } else {
                        updateMarkerAddress('Cannot determine address at this location.');
                        }
                    });
                }


                function geocodePosition2(pos) {

                    // Add lat and lng values to html hidden inputs
                    $('#location_lat2').val(pos.lat);
                    $('#location_lng2').val(pos.lat);

                    // Store lat and lng values to LocalStorage
                    localStorage.setItem('lat', pos.lat);
                    localStorage.setItem('lng', pos.lng);

                    var geocoder = new google.maps.Geocoder;
                    geocoder.geocode({
                        latLng: pos
                    }, function(responses) {
                        if (responses && responses.length > 0) { 
                        updateMarkerTeachingAddress(responses[0].formatted_address);
                        } else {
                        updateMarkerTeachingAddress('Cannot determine address at this location.');
                        }
                    });
                }
                
                // Get current location of user
                function initGeolocation()
                {
                    if( navigator.geolocation )
                    {
                        // Call getCurrentPosition with success and failure callbacks
                        navigator.geolocation.getCurrentPosition( success, fail );
                    }
                    else
                    {
                        alert("Sorry, your browser does not support geolocation services.");
                    }
                }

                // initGeolocation success
                function success(position)
                {
                    // Add lat and lng values to html hidden inputs
                    $('#location_lat').val(position.coords.latitude);
                    $('#location_lng').val(position.coords.longitude);

                    $('#location_lat2').val(position.coords.latitude);
                    $('#location_lng2').val(position.coords.longitude);
                    // Store lat and lng values to LocalStorage
                    localStorage.setItem('lat', position.coords.latitude);
                    localStorage.setItem('lng', position.coords.longitude);

                    // Store address lat and ong in location variable
                    location.lat = position.coords.latitude;
                    location.lng = position.coords.longitude;


                    geocodePosition(location);
                    geocodePosition2(location);
                }

                // initGeolocation fail
                function fail()
                {
                    // Could not obtain location
                    alert('Could not obtain location');
                }

                function updateMarkerAddress(address){
                    $("input[name='address']").val(address);    
                }

                function updateMarkerTeachingAddress(address2){
                    $("input[name='teaching_address']").val(address2);    
                }
            </script>
        @endif
    @endif
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
                                timer: 2000
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
                        timer: 2000
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
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
            });
        </script>
    @endforeach
</body>

</html>