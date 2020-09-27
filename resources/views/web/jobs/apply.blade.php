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

                                <div class="big-label">{{trans('web.phone_main')}}</div>
                                <div class="userName">
                                    <input type="tel" id="mob" name="phone_main" value="{{auth()->user()->phone_main}}" required />

                                </div>

                                <div class="big-label">{{trans('web.phone_secondary')}}</div>
                                <div class="userName">
                                    <input type="tel" id="mob" name="phone_secondary" value="{{auth()->user()->phone_secondary}}" />

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
                                            <option value="{{$job->id}}" @if($job->id == $job_id) selected @endif>{{$job->{'name_'.session('lang')} }} - {{$job->address}}</option>
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
                                <div id="map-canvas" style="flex: 0 0 100%;margin-bottom: 20px;height:400px;"></div>
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
                'job_title': jobs[i].name_ar
            };
            predefinedLocations.push(item);
        }

        var jsonUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+seeker_location.lat+','+seeker_location.lng+'&key=AIzaSyDJZeYDmZKwcHVaO9APCWP_04lYzaNK0o4';
        $.ajax({
            type: "POST",
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'text/plain',
            },
            dataType: 'json',
            url: jsonUrl,
            complete: function(data){

                var lat = (data.responseJSON.results[0].geometry.bounds.northeast.lat + data.responseJSON.results[0].geometry.bounds.southwest.lat) / 2;
                var lng = (data.responseJSON.results[0].geometry.bounds.northeast.lng + data.responseJSON.results[0].geometry.bounds.southwest.lng) / 2;

                var p1, p2;

                predefinedLocations.forEach(function(obj){
                    p1 = new google.maps.LatLng(obj.lat, obj.lng);
                    p2 = new google.maps.LatLng(lat, lng);

                    obj.distance = calcDistance(p1, p2);
                });

                // sort by distance
                var locationInfo = predefinedLocations.sort(compare);

                initializeGoogleMap(locationInfo, lat, lng);
            }
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
            setMarker(lat, lng, map, "Your Location", i, infowindow);

            // set marker for closest location
            var nearest = 'الأقرب: '+locationInfo[0].job_title+' - '+locationInfo[0].name;
            setMarker(locationInfo[0].lat, locationInfo[0].lng, map, nearest, i, infowindow);

            for (var j = 1; j < locationInfo.length; j++) {
                // set marker for other location
                setMarker(locationInfo[j].lat, locationInfo[j].lng, map, locationInfo[j].job_title+' - '+locationInfo[0].name, i, infowindow);
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
            }); 

            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
            })(marker, i));

        }
    </script>
    
@endsection