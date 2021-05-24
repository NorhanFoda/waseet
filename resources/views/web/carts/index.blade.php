@extends('web.layouts.app')
@section('title', trans('web.cart'))
@section('description', trans('web.waseet_description'))
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.cart')}}</h5>
                    <p data-aos="fade-up">{{trans('web.cart_text')}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile margin-div text-right-dir">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="second_title second_color text-center" data-aos="fade-in">{{trans('web.cart')}}</h5>

                    <!--start edit-list-->
                    <div class="prof-edit-list order-list shipping-list">
                        <ul class="list-unstyled">
                            <!--start product-->
                            @foreach ($carts as $cart)
                                <li class="gray-bg" data-aos="fade-up">
                                    <div class="packsWrap book-details">
                                        <i class="fa fa-times left-icon remove-icon" data-id="{{$cart->id}}"></i>
                                        <div class="pack_img md-center">
                                            <img src="{{$cart->bag->images()->where('image_type', 'slider')->first() ? $cart->bag->images()->where('image_type', 'slider')->first()->path : 'images/product-avatar.png'}}" alt="" />
                                        </div>

                                        <div class="pack-width">
                                            <div class="pack_name">
                                                <p>{{$cart->bag->{'name_'.session('lang')} }} 
                                                    @if($cart->buy_type == 1) ({{trans('web.buy_online')}}) @endif
                                                    @if($cart->buy_type == 2) ({{trans('web.print_content')}}) @endif
                                                </p>

                                            </div>

                                            <div class="pack_rate">
                                                <form action="">
                                                    @if($cart->bag->ratings->count() > 0)
                                                        <input type="radio" id="st5" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 5) checked @endif />
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st4" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 4) checked @endif />
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st3" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 3) checked @endif />
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st2" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 2) checked @endif />
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st1" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 1) checked @endif />
                                                        <label for="st1">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @else
                                                        <input type="radio" id="st55" name="pack"/>
                                                        <label for="st55">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st44" name="pack"/>
                                                        <label for="st44">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st33" name="pack"/>
                                                        <label for="st33">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st22" name="pack"/>
                                                        <label for="st22">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st11" name="pack"/>
                                                        <label for="st11">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @endif
                                                </form>
                                            </div>

                                            <div class="det-list first_color">
                                                <div class="second_color">{{$cart->bag->price}} {{trans('admin.sr')}}</div>
                                                <form method="" action="">
                                                    <div class="counter-div">
                                                        <span class="responsive-text">{{trans('web.count')}} : {{$cart->quantity}}</span>
                                                        <div class="inner-inputs">
                                                            <div class="counter">
                                                                <span class="minus" data-id="{{$cart->id}}" data-price="{{$cart->bag->price}}">-</span>
                                                                <input  type="number" id="count_{{$cart->id}}" class="cart-input" min="1" value="{{$cart->quantity}}" />
                                                                <span class="plus" data-id="{{$cart->id}}" data-price="{{$cart->bag->price}}">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="secondary-price first_color">{{trans('web.sub_price')}} :
                                            <span class="second_color prices" id="sub_price_{{$cart->id}}">{{$cart->bag->price * $cart->quantity}} {{trans('admin.sr')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <!--end product-->
                        </ul>
                    </div>
                    <!--end edit-->

                <div class="circle-list  first_color">
                    <ul class="list-unstyled shipping-list2">
                        <li>
                            {{trans('web.shipping_fees')}} : <span>{{$shipping_fees}} {{trans('admin.sr')}}</span>
                        </li>

                        <li>
                            {{trans('web.sub_price_total')}} : <span id="sub_price_total">{{$sub_total}} {{trans("admin.sr")}}</span>
                        </li>

                        <li>
                            {{trans('web.total')}} : <span id="total">{{$total}} {{trans("admin.sr")}}</span>
                        </li>
                    </ul>
                </div>

                <div class="submit col-12 text-center">
                    <button type="button" class="custom-btn" 
                            data-toggle="modal" data-target="#select-method"
                        >
                        {{trans('web.continue_pay')}}
                    </button>
                </div>

            </div>
        </div>
    </section>

    {{-- select method modal start --}}
    <div class="modal fade" id="select-method" tabindex="-1" role="dialog" aria-labelledby="address-choose" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title first_color">{{trans('web.payment_method')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right-dir">
                    <div class="custom-checkboxes" data-aos="fade-in">
                        <div class="custom-check">
                            <input type="radio" id="print_content" name="payment_method" class="payment_type" value="{{2}}" />
                            <label for="print_content">{{trans('web.print_content')}}</label>
                        </div>
                        
                        <div class="custom-check">
                            <input type="radio" id="buy_online" name="payment_method" class="payment_type" value="{{1}}" />
                            <label for="buy_online">{{trans('web.buy_online')}}</label>
                        </div>
                    </div>

                    <div class="signUpp gray-form aos-init aos-animate" id="address_form" data-aos="fade-in" hidden>

                        @if(count(auth()->user()->addresses) == 0)
                            <form action="{{route('addresses.store', 'order')}}" method="POST">
                                @csrf
                                <div class="inputs-contain">
                                    
                                    <div class="userName">
                                        <input type="text" name="address" id="pac-input" class="form-control" required="">
                                        <input type="hidden" name="lat" value="" id="location_lat">
                                        <input type="hidden" name="long" value="" id="location_lng">
                                        <input type="hidden" name="city" value="" id="city">
                                        <label>
                                            <i class="fa fa-map"></i> {{trans('web.address_details')}}
                                        </label>
                                    </div>

                                    <div class="map" style="margin-bottom:20px">
                                        <div id="gmap" style="width:100%;height:400px;">
                                    </div>
                                    
                                
                                </div>
                                <div class="submit text-center">
                                    <button type="submit" class="custom-btn">{{trans('web.add')}}</button>
                                </div>
                            </form>
                        @else

                            @foreach(auth()->user()->addresses as $address)
                                <div class="custom-check">
                                    <input type="radio" name="address" value="{{$address->id}}" id="check-{{$address->id}}" @if($loop->iteration == 1) checked @endif>
                                    <label for="check-{{$address->id}}">{{$address->address}}</label>
                                </div>
                            @endforeach

                            <div class="text-center">
                                <a href="{{route('payment.prepare_order', ['buy_type' => 2, 'address_id' => $address->id])}}" id="continue" class="custom-btn">{{trans('web.continue')}} </a>
                            </div>
                        @endif
                    </div>

                </div>
                
                
                    <div class="text-center" id="continue_btn" hidden>
                    </div>
            </div>
        </div>
    </div>
    {{-- select method modal end --}}
    
@endsection

@section('scripts')
    <script>
// localStorage.clear();
        $(document).ready(function(){

            $('.payment_type').click(function(){
                    $('#address_form').attr('hidden', true);
                    $('#continue_btn').attr('hidden', true);

                if($(this).val() == 2){
                    $('#address_form').attr('hidden', false);
                }
                else{
                    $('#continue_btn').attr('hidden', false);
                    $('#continue_btn').html(`<a href="{{route('payment.prepare_order', ['buy_type' => 1, 'address_id' => `+$("input[name='address']:checked").val()+`])}}" id="continue" class="custom-btn">{{trans('web.continue')}} </a>`);
                }
            });

            $('.edit_cart').click(function(){
                $.ajax({
                    url: '{{route("carts.edit_buy_type")}}',
                    type: "PUT",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", 
                            bag_id: $(this).data('bag_id'),
                            user_id: $(this).data('user_id'),
                            buy_type: $(this).data('buy_type') 
                        },
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
            });

            // Update data on plus click
            $(".plus").click(function(){
                var input_val = parseInt($(this).parent().find(".cart-input").val()) + 1;
                $(this).parent().find(".cart-input").val(input_val);

                // Update sub price
                var cart_id = $(this).data('id');

                $.ajax({
                    url: '{{route("carts.update_quantity")}}',
                    type: "PUT",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", 
                            quantity: input_val,
                            id: cart_id
                        },
                    success: function(data){
                        $('#sub_price_'+cart_id).text(data['single_price']);
                        $('#sub_price_total').text(data['sub_total']+' {{trans("admin.sr")}}');
                        $('#total').text(data['total']+' {{trans("admin.sr")}}');
                    }
                });

            });

            // Update data on minus click
            $(".minus").click(function(){
                if ($(this).parent().find(".cart-input").val() > 1){
                    var input_val = parseInt ($(this).parent().find(".cart-input").val()) - 1;
                    $(this).parent().find(".cart-input").val(input_val);

                    // Update sub price
                    var cart_id = $(this).data('id');

                    $.ajax({
                        url: '{{route("carts.update_quantity")}}',
                        type: "PUT",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", 
                                quantity: input_val,
                                id: cart_id
                            },
                        success: function(data){
                            $('#sub_price_'+cart_id).text(data['single_price']);
                            $('#sub_price_total').text(data['sub_total']+' {{trans("admin.sr")}}');
                            $('#total').text(data['total']+' {{trans("admin.sr")}}');
                        }
                    });
                }
                else{}
            });

            // Delete cart
            $('.remove-icon').click(function(){
                var cart_id = $(this).data('id');
                $(this).parent().parent().remove();

                $.ajax({
                    url: '{{route("carts.delete")}}',
                    type: "DELETE",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", 
                            id: cart_id
                        },
                    success: function(data){
                        $('#sub_price_'+cart_id).text(data['single_price']);
                        $('#sub_price_total').text(data['sub_total']+' {{trans("admin.sr")}}');
                        $('#total').text(data['total']+' {{trans("admin.sr")}}');
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

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");

            // prevent form submit on click (enter btn)
            google.maps.event.addDomListener(input, 'keydown', function(event) { if (event.keyCode === 13) { event.preventDefault(); } }); 
            
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
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
            
            google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            address_marker.setPosition(location);
            map.setCenter(location);
            geocodePosition(address_marker.getPosition());
        }
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

                    //get city start
                    var filtered_array = responses[0].address_components.filter(function(address_component){
                        return address_component.types.includes("administrative_area_level_2");
                    }); 
                    var city = filtered_array.length ? filtered_array[0].long_name: "";
                    $('#city').val(city);
                    // console.log(responses[0].address_components);
                    // console.log(city);
                    // get city end

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