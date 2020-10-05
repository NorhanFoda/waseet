@extends('web.layouts.app')
@section('title', trans('web.apply_to_job'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{$title}}</h5>
                    <p data-aos="fade-up">
                        {!! $text !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="{{route('jobs.update_seeker')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="inputs-contain">
                                <div class="big-label">{{trans('web.full_name')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" name="name" value="{{auth()->user()->name}}" required />

                                </div>

                                <div class="big-label">{{trans('web.email')}}</div>
                                <div class="userName">
                                    <input type="email" id="mail" name="email" disabled value="{{auth()->user()->email}}" required />

                                </div>

                                @php
                                    if(strpos(auth()->user()->phone_main, ',') !== false){
                                        $arr = explode(',' , auth()->user()->phone_main);
                                        $key = $arr[0];
                                        $phone_main = $arr[1];
                                    }
                                    else{
                                        $key = '';
                                        $phone_main = auth()->user()->$phone_main;
                                    }
                                    
                                    $phone_secondary = null;
                                    $sec_key = null;
                                    if(auth()->user()->phone_secondary != null && strpos(auth()->user()->phone_secondary, ',') !== false){
                                        $arr2 = explode(',' , auth()->user()->phone_secondary);
                                        $sec_key = $arr2[0];
                                        $phone_secondary = $arr2[1];
                                    }
                                    else{
                                        $sec_key = '';
                                        $phone_secondary = auth()->user()->$phone_secondary;
                                    }
                                    
                                @endphp

                                <div class="big-label">{{trans('web.phone_main')}}</div>
                                <div class="userName">
                                    <input type="hidden" id="mob" value="{{$key}} {{$phone_main}}" />
                                    <input type="hidden"  class="hidden-in" name="full"/>
                                    <input type="tel" class="phone-input-style" name="phone_main" minlength="9" maxlength="11" value="{{$phone_main}}" required />

                                </div>

                                <div class="big-label">{{trans('web.phone_secondary')}}</div>
                                <div class="userName">
                                    <input type="hidden" id="sec_mob" value="{{$sec_key}} {{$phone_secondary}}" />
                                    <input type="hidden"  class="sec_hidden-in" name="sec_full"/>
                                    <input type="tel" class="active phone-input-style" minlength="9" maxlength="11" name="phone_secondary" value="{{$phone_secondary}}" />

                                </div>

                                <div class="big-label">{{trans('web.address')}}</div>
                                <div class="userName">
                                    <input type="text" id="country" name="address" value="{{auth()->user()->address}}" required />

                                </div>


                                <div class="big-label">{{trans('web.applied_job')}}</div>
                                <div class="userName">
                                    <select name="job_id" class="form-control" required>
                                        <option value="{{null}}">{{trans('web.applied_job')}}</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{$job->id}}" @if($job->id == $job_id) selected @endif>{{$job->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="big-label">{{trans('web.exper_years')}}</div>
                                <div class="userName">
                                    <input type="number" id="confirm" name="exper_years" value="{{auth()->user()->exper_years}}" required />

                                </div>

                                <div class="big-label">{{trans('web.salary')}}</div>
                                <div class="userName">
                                    <input type="number" id="confirm2" name="salary" value="{{auth()->user()->salary_month}}" required />

                                </div>

                                <div class="big-label">{{trans('web.cv')}} : </div>
                                <div class="userName custom-file">
                                    <input type="file" id="file-up" accept="application/pdf" name="cv" />
                                    <label for="file-up">
                                        <i class="fa fa-upload"></i> <span></span>
                                    </label>
                                </div>

                                @if(auth()->user()->document != null)
                                    <div class="userName custom-file">
                                        <a href="{{auth()->user()->document->path}}">{{trans('web.view_cv')}}</a>
                                    </div>
                                @endif

                                {{-- MAP start --}}
                                <div id="map-canvas"></div>
                                {{-- MAP end --}}

                            </div>

                            <div class="submit">
                                <button type="submit" class="custom-btn">{{trans('web.send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var predefinedLocations = [];

            // get all jobs
            var jobs = @json($jobs);

            // get the authed seeker
            var seeker = @json(auth()->user());

            // get authed seeker address, lat and lng
            var seeker_location = {
                'name': seeker.address,
                'lat': seeker.lat,
                'lng': seeker.long,
            }
            
            // get jobs address, lat and lng and push them to predefinedLocations list
            for(var i = 0; i < jobs.length; i++){
                var item = {
                    'name': jobs[i].address,
                    'lat': jobs[i].lat,
                    'lng': jobs[i].long,
                };
                predefinedLocations.push(item);
            }

            // var jsonUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+seeker_location.lat+','+seeker_location.lng+'&key=AIzaSyDJZeYDmZKwcHVaO9APCWP_04lYzaNK0o4';
            // $.ajax({
            //     type: "POST",
            //     headers:{
            //         'Accept': 'application/json',
            //         'Content-Type': 'text/plain',
            //     },
            //     dataType: 'json',
            //     url: jsonUrl,
            //     complete: function(data){
            //         var lat = (data.responseJSON.results[0].geometry.bounds.northeast.lat + data.responseJSON.results[0].geometry.bounds.southwest.lat) / 2;
            //         var lng = (data.responseJSON.results[0].geometry.bounds.northeast.lng + data.responseJSON.results[0].geometry.bounds.southwest.lng) / 2;

            //         var p1, p2;

            //         predefinedLocations.forEach(function(obj){
            //             p1 = new google.maps.LatLng(obj.lat, obj.lng);
            //             p2 = new google.maps.LatLng(lat, lng);

            //             obj.distance = calcDistance(p1, p2);
            //         });

            //         // sort by distance
            //         var locationInfo = predefinedLocations.sort(compare);

            //         initializeGoogleMap(locationInfo, lat, lng);
            //     }
            // });

            var pos = {'lat': seeker_location.lat , 'lng': seeker_location.lng}
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                var lat = (responses[0].geometry.bounds.northeast.lat + responses[0].geometry.bounds.southwest.lat) / 2;
                var lng = (responses[0].geometry.bounds.northeast.lng + responses[0].geometry.bounds.southwest.lng) / 2;

                var p1, p2;

                predefinedLocations.forEach(function(obj){
                    p1 = new google.maps.LatLng(obj.lat, obj.lng);
                    p2 = new google.maps.LatLng(lat, lng);

                    obj.distance = calcDistance(p1, p2);
                });

                // sort by distance
                var locationInfo = predefinedLocations.sort(compare);

                initializeGoogleMap(locationInfo, lat, lng);    
            });

            var map;

            function initializeGoogleMap(locationInfo, lat, lng) {
                var mapOptions = {
                    zoom: 15
                };

                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                // zoom to only the input zipcode and closest location    
                var latlngbounds = new google.maps.LatLngBounds();
                latlngbounds.extend(new google.maps.LatLng(locationInfo[0].lat, locationInfo[0].lng));
                latlngbounds.extend(new google.maps.LatLng(lat, lng));
                map.fitBounds(latlngbounds);

                var infowindow = new google.maps.InfoWindow();

                var marker, i;

                // set marker for input location
                setMarker(lat, lng, map, "You are here!", i, infowindow);

                // set marker for closest location
                setMarker(locationInfo[0].lat, locationInfo[0].lng, map, locationInfo[0].name, i, infowindow);

                for (var j = 1; j < locationInfo.length; j++) {
                    // set marker for other location
                    setMarker(locationInfo[j].lat, locationInfo[j].lng, map, '', locationInfo[j].name, i, infowindow);
                }
            }

            function calcDistance(p1, p2) {
                return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
            }

            function compare(a, b) {
                if (parseFloat(a.distance) < parseFloat(b.distance)) {
                    return -1;
                }

                if (parseFloat(a.distance) > parseFloat(b.distance)) {
                    return 1;
                }

                return 0;
            }

            function setMarker(lat, lng, map, content, i, infowindow) {

                var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map,
                // icon: icon
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map, marker);
                }
                })(marker, i));

            }
        });

        /**
       * 
       * Handling country key for phones input according to stupids opinion
       * **/
      $(".no-val-input").val('');
      $(".iti__selected-dial-code").val();

      var phone_number = window.intlTelInput(document.querySelector("#mob"), {
        separateDialCode: true,
        preferredCountries: ["sa", "kw", "om", "bh", "jo", "iq", "ae", "eg"],
        hiddenInput: "full",
        utilsScript: "{{asset('web/js/vendor/utils.js')}}"
      });
      
      var sec_phone_number = window.intlTelInput(document.querySelector("#sec_mob"), {
        separateDialCode: true,
        preferredCountries: ["sa", "kw", "om", "bh", "jo", "iq", "ae", "eg"],
        hiddenInput: "sec_full",
        utilsScript: "{{asset('web/js/vendor/utils.js')}}"
      });


      $("form").submit(function() {
          var phone_val = $(".iti__selected-dial-code:eq(0)").text();
          var sec_phone_val = $(".iti__selected-dial-code:eq(1)").text();
          $(".phone-input-style").prev(".hidden-in").val(phone_val);
          $(".phone-input-style").prev(".sec_hidden-in").val(sec_phone_val);
      });

    </script>
    
@endsection