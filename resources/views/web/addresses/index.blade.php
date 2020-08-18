@extends('web.layouts.app')
@section('title', trans('web.addresses'))
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

    <section class="profile margin-div text-right-dir">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="second_title second_color text-center">{{trans('web.addresses')}}</h5>
                    <div class="gray-bg">


                        <!--start edit-list-->
                        <div class="prof-edit-list shipping-list">
                            <ul class="list-unstyled">
                                @foreach ($addresses as $address)
                                    <li data-aos="fade-up">
                                        <a>
                                            <i class="fa fa-user"></i>
                                            {{-- {{$address->country->{'name_'.session('lang')} }} - {{$address->city->{'name_'.session('lang')} }} - {{trans('web.ps')}}: {{$address->postal_code}} --}}
                                            {{$address->address}}
                                            <i class="fa fa-times left-icon" data-id="{{$address->id}}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <!--end edit-->

                        <div class="submit col-12 text-center margin-div"  data-aos="fade-up">
                            <button  data-toggle="modal" data-target="#add-address" class="custom-btn">{{trans('web.add_address')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- add address modal start --}}
    <div class="modal fade" id="add-address" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title first_color">{{trans('web.add_address')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right-dir">
                    <div class="signUp gray-form aos-init aos-animate" data-aos="fade-in">
                        <form action="{{route('addresses.store')}}" method="POST">
                            @csrf
                            <div class="inputs-contain">
                                {{-- <div class="userName custom-select2">
                                    <select  class="custom-input" name="country_id" id="country_id" required>
                                        <option selected disabled value="{{null}}">{{trans('web.country')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-icon">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </span>
                                </div> --}}

                                {{-- <div class="userName custom-select2 city-add-2">
                                    <div class="add-address">
                                        <select  class="custom-input" name="city_id" id="city_id" required>
                                            <option selected disabled value="{{null}}">{{trans('web.city')}}</option>
                                            @foreach ($cities as $city)
                                                <option value="{{$city->id}}">{{$city->{'name_'.session('lang')} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-icon">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </span>
                                </div> --}}
                                
                                {{-- <div class="userName custom-select2">
                                    <div class="add-address">
                                        <div class="sub-add-address">
                                            <i class="fas fa-plus"></i> 
                                            <span class="city-text">{{trans('web.add_city')}}</span>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                {{-- Add city modal start --}}
                                {{-- <div class="city-add">
                                    <div class="inputs-contain">
                                        <div class="userName">
                                            <input type="text" name="name_ar" id="city_name_ar">
                                            <label>
                                                {{trans('admin.name_ar')}}
                                            </label>
                                        </div>

                                        <div class="userName">
                                            <input type="text" name="name_en" id="city_name_en">
                                            <label>
                                                {{trans('admin.name_en')}}
                                            </label>
                                        </div>
                                    </div>

                                 

                                </div> --}}
                                {{-- Add city modal end --}}

                                <div class="userName">
                                    <input type="text" name="address" required="">
                                    <input type="hidden" name="lat" value="" id="location_lat">
                                    <input type="hidden" name="long" value="" id="location_lng">
                                    <input type="hidden" name="city" value="" id="city">
                                    <label>
                                        <i class="fa fa-map"></i> {{trans('web.address_details')}}
                                    </label>
                                </div>

                                <div class="map-div">
                                    <div id="gmap" style="width:100%;height:400px;">
                                </div>
                                
                                {{-- <div class="userName">
                                    <input type="number" name="postal_code" required="">
                                    <label>
                                        <i class="fa fa-envelope"></i>{{trans('web.postal_code')}} 
                                    </label>
                                </div> --}}

                            </div>
                            <div class="submit">
                                <button type="submit" id="add_address" class="custom-btn">{{trans('web.add')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add address modal end --}}

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Get cities of selected country
            $('#country_id').change(function(){
                $.ajax({
                    url: "{{route('countries.getCities')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
                    success: function(data){

                        $('#city_id').html(data);

                        // Open adding city modal
                        $(".sub-add-address").click(function () {
                            if($(".city-text").text() == '{{trans("web.select_city")}}'){
                                $(".city-text").text('{{trans("web.add_city")}}');    
                                $('#city_name_ar').prop('required',false);
                                $('#city_name_en').prop('required',false);
                                $('#city_name_ar').val('');
                                $('#city_name_en').val('');
                            }
                            else{
                                $(".city-text").text('{{trans("web.select_city")}}');  
                                $('#city_id').val('');
                                $('#city_id').prop('required',false);
                                $('#city_name_ar').prop('required',true);
                                $('#city_name_en').prop('required',true);
                            }
                            
                            $(".city-add-2").slideToggle("fast");
                            $(".city-add").slideToggle("fast");
                        });
                    }
                });
            });

            // Delete address
            $('.left-icon').click(function(){
                var address_id = $(this).data('id');
                $(this).parent().parent().remove();
                $.ajax({
                    url: "{{route('addresses.delete')}}",
                    type: "DELETE",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", address_id: address_id},
                    success: function(data){
                    }
                });

            });
        });

        initGeolocation();
        // MAP START
        // Initiat google map
        function initMap(){
            
            var lat = localStorage.getItem('lat') ? localStorage.getItem('lat') : 23.885942;
            var lng = localStorage.getItem('lng') ? localStorage.getItem('lng') : 45.079163;

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
            localStorage.setItem('lat', pos.lat);
            localStorage.setItem('lng', pos.lng);

            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) { 
                    // "الرياض"
                    // "Al Riyadh"
                    // $('#city').val(responses[0].address_components[4].long_name);

                    updateMarkerAddress(responses[0].formatted_address);
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
            localStorage.setItem('lat', position.coords.latitude);
            localStorage.setItem('lng', position.coords.longitude);

            // Store address lat and ong in location variable
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
            $("input[name='address']").val(address);    
        }
        // MAP END
    </script>
@endsection