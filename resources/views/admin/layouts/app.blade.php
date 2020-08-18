<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{(\App()->getLocale()=='ar')?'data-textdirection="rtl"':'data-textdirection="ltr"'}}">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') | @yield('pageSubTitle')</title>
    <link rel="apple-touch-icon" href="{{asset('/images/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    @if(\App()->getLocale()=='ar')
        <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/vendors-rtl.min.css')}}">

    @else
        <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/vendors.min.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/shepherd-theme-default.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    @php $locale=(\App()->getLocale()=='ar')?'-rtl':''; @endphp
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/pages/dashboard-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/plugins/tour/tour.css')}}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css-rtl/pages/data-list-view.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" type="text/css" />

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css'.$locale.'/style.css')}}">
    @if($locale=='ar')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/style-rtl.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom-style.css')}}">



    <!-- END: Custom CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJZeYDmZKwcHVaO9APCWP_04lYzaNK0o4&libraries=places&callback=initMap&language={{ \App::getLocale() }}" defer></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

@yield('content')

    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('admin.layouts.footer')

{{-- MAP START --}}
@if(\Request::route()->getName() == 'direct_teachers.create')
    <script>
        initGeolocation();
       // Initiat google map
      function initMap(){
          
          var lat = localStorage.getItem('lat') ? localStorage.getItem('lat') : 23.885942;
          var lng = localStorage.getItem('lng') ? localStorage.getItem('lng') : 45.079163;
          var lat2 = parseFloat(lat) + 0.08;
          var lng2 = parseFloat(lng) + 0.08;

          // Center the map to user current location
          const map = new google.maps.Map(document.getElementById("gmap"), {
            zoom: 10,
            center: { lat: parseFloat(lat), lng: parseFloat(lng) } // Current user location or SA.
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
          localStorage.setItem('lat2', pos.lat);
          localStorage.setItem('lng2', pos.lng);

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

        $('#location_lat2').val(position.coords.latitude + 0.08);
        $('#location_lng2').val(position.coords.longitude + 0.08);

          // Store lat and lng values to LocalStorage
        localStorage.setItem('lat', position.coords.latitude);
        localStorage.setItem('lng', position.coords.longitude);
        localStorage.setItem('lat2', position.coords.latitude + 0.08);
        localStorage.setItem('lng2', position.coords.longitude + 0.08);

          // Store address lat and ong in location variable
          location.lat = position.coords.latitude;
          location.lng = position.coords.longitude;
          location.lat2 = position.coords.latitude + 0.08;
          location.lng2 = position.coords.longitude + 0.08;


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

@if(\Request::route()->getName() == 'direct_teachers.edit')
    <script>
        // Initiat google map
      function initMap(){
          
        //   var lat = localStorage.getItem('lat') ? localStorage.getItem('lat') : 23.885942;
        //   var lng = localStorage.getItem('lng') ? localStorage.getItem('lng') : 45.079163;

        var lat = $('#location_lat').val() != null ? $('#location_lat').val() : 23.885942;
        var lng = $('#location_lng').val() != null ? $('#location_lng').val() : 45.079163;
        var lat2 = $('#location_lat2').val() != null ? $('#location_lat2').val() : 23.885942;
        var lng2 = $('#location_lng2').val() != null ? $('#location_lng2').val() : 45.079163;

          // Center the map to user current location
          const map = new google.maps.Map(document.getElementById("gmap"), {
            zoom: 10,
            center: { lat: parseFloat(lat), lng: parseFloat(lng) } // Current user location or SA.
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
          localStorage.setItem('lat2', pos.lat);
          localStorage.setItem('lng2', pos.lng);

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
        $('#location_lat').val('{{$teacher->lat}}');
        $('#location_lng').val('{{$teacher->long}}');

        $('#location_lat2').val('{{$teacher->teaching_lat}}');
        $('#location_lng2').val('{{$teacher->teaching_long}}');
          // Store lat and lng values to LocalStorage
        localStorage.setItem('lat', '{{$teacher->lat}}');
        localStorage.setItem('lng', '{{$teacher->long}}');
        localStorage.setItem('lat2', '{{$teacher->teaching_lat}}');
        localStorage.setItem('lng2', '{{$teacher->teaching_long}}');

          // Store address lat and ong in location variable
        location.lat = '{{$teacher->lat}}';
        location.lng = '{{$teacher->long}}';
        location.lat2 = '{{$teacher->teaching_lat}}';
        location.lng2 = '{{$teacher->teaching_long}}';


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

@if(\Request::route()->getName() == 'jobs.create' || \Request::route()->getName() == 'jobs.edit' ||
    \Request::route()->getName() == 'organizations.create' || \Request::route()->getName() == 'organizations.edit' ||
    \Request::route()->getName() == 'seekers.create' || \Request::route()->getName() == 'seekers.edit' ||
    \Request::route()->getName() == 'online_teachers.create' || \Request::route()->getName() == 'online_teachers.edit')
    <script>
        initGeolocation();
            // MAP START
            // Initiat google map
            function initMap(){
                
                var lat;
                var lng;

                if('{{\Request::route()->getName()}}' == 'jobs.create' || '{{\Request::route()->getName()}}' == 'organizations.create' ||
                    '{{\Request::route()->getName()}}' == 'seekers.create' || '{{\Request::route()->getName()}}' == 'online_teachers.create'){

                    lat = localStorage.getItem('job_lat') ? localStorage.getItem('job_lat') : 23.885942;
                    lng = localStorage.getItem('job_lng') ? localStorage.getItem('job_lng') : 45.079163;
                }
                else if('{{\Request::route()->getName()}}' == 'jobs.edit' || '{{\Request::route()->getName()}}' == 'organizations.edit' || 
                        '{{\Request::route()->getName()}}' == 'seekers.edit' || '{{\Request::route()->getName()}}' == 'online_teachers.edit'){
                            
                    lat = $('#location_lat').val() != null ?  $('#location_lat').val() : 23.885942;
                    lng = $('#location_lng').val() != null ? $('#location_lng').val() : 45.079163;
                }

                // Center the map to user current location
                const map = new google.maps.Map(document.getElementById("gmap"), {
                    zoom: 10,
                    center: { lat: parseFloat(lat), lng: parseFloat(lng) } // Current user location or SA.
                });

                // Add address marker on map
                var address_marker = new google.maps.Marker({
                    position:  { lat:parseFloat(lat), lng: parseFloat(lng) },
                    draggable: true,
                    title:"Job Location"
                });

                // add info window for address marker
                var infowindow = new google.maps.InfoWindow();  
                google.maps.event.addListener(address_marker, 'mouseover', (function(marker) {  
                    return function() {  
                        var content = "<div>Job Location</div>"; 
                        infowindow.setContent(content);  
                        infowindow.open(map, marker);  
                    }  
                })(address_marker));  

                // To add the marker to the map, call setMap();
                address_marker.setMap(map);

                // Add event listner to address_marker
                google.maps.event.addListener(address_marker, 'dragend', function() {
                    geocodePosition(address_marker.getPosition());
                });
            }

            function geocodePosition(pos) {

                // Add lat and lng values to html hidden inputs
                $('#location_lat').val(pos.lat);
                $('#location_lng').val(pos.lat);

                // Store lat and lng values to LocalStorage
                localStorage.setItem('job_lat', pos.lat);
                localStorage.setItem('job_lng', pos.lng);

                var geocoder = new google.maps.Geocoder;
                geocoder.geocode({
                    latLng: pos
                }, function(responses) {
                    if (responses && responses.length > 0) { 
                        // console.log(responses[0].address_components[4].long_name);
                        // updateMarkerAddress(responses[0].formatted_address);
                        updateMarkerAddress(responses[0]);
                    } else {
                    updateMarkerAddress('Cannot determine address at this location.');
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

                // Store lat and lng values to LocalStorage
                localStorage.setItem('job_lat', position.coords.latitude);
                localStorage.setItem('job_lng', position.coords.longitude);

                // Store address lat and long in location variable
                location.lat = position.coords.latitude;
                location.lng = position.coords.longitude;


                geocodePosition(location);
            }

            // initGeolocation fail
            function fail()
            {
                // Could not obtain location
                alert('Could not obtain location');
            }

            function updateMarkerAddress(address){
                // console.log(address);
                $("input[name='address']").val(address.formatted_address); 

                if('{{\Request::route()->getName()}}' == 'jobs.create' || '{{\Request::route()->getName()}}' == 'jobs.edit'){
                    $("input[name='country']").val(address.address_components[4].long_name);    
                }
            }
            // MAP END
    </script>
@endif


{{-- MAP END --}}

<!-- BEGIN: Vendor JS-->
<script src="{{asset('admin/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/shepherd.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/polyfill.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('admin/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin/js/core/app.js')}}"></script>
<script src="{{asset('admin/js/scripts/components.js')}}"></script>
<!-- END: Theme JS-->
<script src="{{asset('admin/js/scripts/ui/data-list-view.js')}}"></script>

<!-- BEGIN: Page JS-->
{{-- <script src="{{asset('admin/js/scripts/pages/dashboard-analytics.js')}}"></script> --}}
<script src="{{asset('admin/js/scripts/extensions/sweet-alerts.js')}}"></script>
<!-- END: Page JS-->

<!-- BEGIN: Main JS-->
<script src="{{asset('admin/js/scripts/main.js')}}"></script>
<!-- END: Main JS-->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"> </script> 
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"> </script>


@yield('scripts')

@if(\App::getLocale() == 'ar')
    <script> 
        $(document).ready(function () { 
            $('#data_table, .data_table').DataTable({ 
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json" }, 
            });
        });
    </script>
@else
    <script> 
        $(document).ready(function () { 
            $('#data_table, .data_table').DataTable({ 
            });
        });
    </script>
@endif

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

    $(document).on('change', '.approved', function(){
        $.ajax({
            url: "{{route('users.approve_account')}}",
            type: "POST",
            dataType: 'html',
            data: {"_token": "{{ csrf_token() }}", id: $(this).data('user_id'), approved: $(this).val() },
            success: function(data){
                data = JSON.parse(data);
                if(data.data == 1){
                    Swal.fire({
                        type: 'success',
                        title: '{{trans('admin.updated')}}',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.reload();
                }
                else if(data.data == 0){
                    Swal.fire({
                        type: 'error',
                        title: '{{trans('admin.error')}}',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.reload();
                }
            }
        });
    })

</script>
{{-- 
@if(session()->has('message'))
    <script>
        Swal.fire({
            title: "{{ session()->get('message')}}",
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
        });
        location.reload();
    </script>
@endif --}}

@if(session()->has('success'))
    <script>
        Swal.fire({
            title: "{{ session()->get('success')}}",
            type: 'success',
            timer: 1500,
            showCancelButton: false,
            showConfirmButton: false,
        });
    </script>
    {{session()->forget('success')}}
@endif

@if(session()->has('error'))
    <script>
        Swal.fire({
            title: "{{ session()->get('error')}}",
            type: 'error',
            timer: 1500,
            showCancelButton: false,
            showConfirmButton: false,
        });
    </script>
    {{session()->forget('error')}}
@endif


</body>
<!-- END: Body-->

</html>
