@extends('web.layouts.app')
@section('title', trans('web.profile'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.profile')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.profile_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <h5 class="second_title second_color text-center margin-div">{{trans('web.edit_job')}}</h5>

    <section class="teacher_info jobs-det">
        <div class="container">
            <div class="info">
                <div class="col-12">
                    <div class="signUp apply-form" data-aos="fade-in">
                        <form action="{{route('jobs.update_job', $job->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="inputs-contain">

                                <div class="big-label">{{trans('admin.name_ar')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" value="{{$job->name_ar}}" name="name_ar" required placeholder="{{trans('admin.name_ar')}}" />

                                </div>

                                <div class="big-label">{{trans('admin.name_en')}} :</div>
                                <div class="userName">
                                    <input type="text" id="username" name="name_en" value="{{$job->name_en}}" required placeholder="{{trans('admin.name_en')}}" />

                                </div>

                                <div class="big-label">{{trans('admin.specialization')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" required name="specialization_id">
                                        <option value="{{null}}">{{trans('admin.specialization')}}</option>
                                        @foreach($pecializations as $spc)
                                          <option value="{{$spc->id}}" @if($job->specialization_id == $spc->id) selected @endif>{{$spc->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>                           
                                </div>

                                <div class="big-label">{{trans('admin.exper_years')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="exper_years" value="{{$job->exper_years}}" required placeholder="{{trans('admin.exper_years')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.work_hours')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="work_hours" value="{{$job->work_hours}}" required placeholder="{{trans('admin.work_hours')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.required_number')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="required_number" value="{{$job->required_number}}" required placeholder="{{trans('admin.required_number')}}" />
                                </div>

                                <div class="big-label">{{trans('admin.free_places')}}</div>
                                <div class="userName">
                                    <input type="number" id="mob" name="free_places" value="{{$job->free_places}}" required placeholder="{{trans('admin.free_places')}}" />
                                </div>

                                <div class="big-label">{{trans('web.age')}}:</div>
                                <div class="userName">
                                    <input type="number" id="country" name="required_age" value="{{$job->required_age}}" required placeholder="{{trans('admin.age')}}" />
                                </div>

                                <div class="big-label">{{trans('web.salary')}} :</div>
                                <div class="userName" disabled>
                                    <input type="text" id="confirm" name="salary" value="{{$job->salary}}" required placeholder="{{trans('admin.salary')}}" />
                                </div>

                                {{-- <div class="big-label">{{trans('web.country')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" id="country_id" required name="country_id">
                                        <option value="{{null}}">{{trans('web.country')}}</option>
                                        @foreach($countries as $country)
                                          <option value="{{$country->id}}" @if($job->country_id == $country->id) selected @endif>{{$country->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>                           
                                </div> --}}

                                {{-- <div class="big-label">{{trans('web.city')}} : </div>
                                <div class="userName">
                                    <select class="custom-input" id="city_id" required name="city_id">
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}" @if($job->city_id == $city->id) selected @endif>{{$city->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="big-label">{{trans('admin.description_ar')}} : </div>
                                <div class="userName">
                                    <textarea name="description_ar" id="city_id" required cols="30" rows="6" placeholder="{{trans('admin.description_ar')}}">{{$job->description_ar}}</textarea>
                                </div>

                                <div class="big-label">{{trans('admin.description_en')}} : </div>
                                <div class="userName">
                                    <textarea name="description_en" id="city_id" required cols="30" rows="6" placeholder="{{trans('admin.description_en')}}">{{$job->description_en}}</textarea>
                                </div>

                                <div class="big-label">{{trans('admin.image')}} : </div>
                                <div class="userName">
                                    <input type="file" id="image" name="image"  accept=".gif, .jpg, .png, .webp" />
                                </div>

                                @if($job->image != null)
                                    <div class="userName">
                                        <img src="{{$job->image->path}}" alt="{{$job->{'name_'.session('lang')} }}" width="100px" height="100px">
                                    </div>
                                @endif

                                {{-- map start --}}
                                {{-- address start --}}
                                <div class="big-label">{{trans('web.location')}} :</div>
                                <div class="userName" disabled>
                                    <input type="text" id="confirm" value="{{$job->address}}" name="address" required placeholder="{{trans('admin.location')}}" />
                                    <input type="hidden" name="lat" value="{{$job->lat}}" id="location_lat">
                                    <input type="hidden" name="long" value="{{$job->long}}" id="location_lng"> 
                                    <input type="hidden" name="country" value="{{$job->country}}" id="country"> 
                                </div>
                                {{-- address end --}}

                                <div class="map-div">
                                    <div id="gmap" style="width:100%;height:400px;">
                                </div>
                                {{-- map end --}}

                            </div>

                            <div class="submit">
                                <button type="submit" class="custom-btn">{{trans('web.save')}}</button>
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
        // $('#country_id').change(function(){
        //     $.ajax({
        //         url: "{{route('countries.getCities')}}",
        //         type: "POST",
        //         dataType: 'html',
        //         data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
        //         success: function(data){
        //             $('#city_id').html(data);
        //         }
        //     });
        // });

        // MAP START
        // Initiat google map
        function initMap(){
            
            // var lat = localStorage.getItem('job_lat') ? localStorage.getItem('job_lat') : 23.885942;
            // var lng = localStorage.getItem('job_lng') ? localStorage.getItem('job_lng') : 45.079163;

            var lat = $('#location_lat').val();
            var lng = $('#location_lng').val();

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
            $("input[name='address']").val(address.formatted_address);    
            $("input[name='country']").val(address.address_components[4].long_name);    
        }
        // MAP END
    </script>
@endsection