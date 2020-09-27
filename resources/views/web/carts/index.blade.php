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
                                            <img src="{{$cart->bag->image}}" alt="" />
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
                            {{trans('web.sub_price_total')}} : <span id="sub_price_total"></span>
                        </li>

                        <li>
                            {{trans('web.total')}} : <span id="total"></span>
                        </li>
                    </ul>
                </div>

                @if(count($carts) > 0)
                    <div class="submit col-12 text-center">
                        <button type="button" class="custom-btn" 
                            @if(count(auth()->user()->addresses) == 0)  
                                data-toggle="modal" data-target="#add-address"
                            @else
                                data-toggle="modal" data-target="#address-choose"
                            @endif
                            >
                            {{trans('web.continue_pay')}}
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </section>

    {{-- Select shipping address modal start --}}
    <div class="modal fade" id="address-choose" tabindex="-1" role="dialog" aria-labelledby="address-choose" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title first_color">{{trans('web.select_shipping_address')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right-dir">
                    <div class="custom-checkboxes" data-aos="fade-in">
                        @if(count(auth()->user()->addresses) > 0)
                            @foreach(auth()->user()->addresses as $address)
                                <div class="custom-check">
                                    <input type="radio" name="address" id="check-{{$address->id}}" @if($loop->iteration == 1) checked @endif>
                                    {{-- <label for="check-{{$address->id}}">{{$address->country->{'name_'.session('lang')} }} - {{$address->city->{'name_'.session('lang')} }} - {{$address->address}}</label> --}}
                                    <label for="check-{{$address->id}}">{{$address->address}}</label>
                                </div>
                            @endforeach

                            <div class="text-center">
                                <a href="{{route('payment.prepare_order', $address->id)}}" id="continue" class="custom-btn">{{trans('web.continue')}} </a>
                            </div>
                            
                        @else
                            <div class="submit col-12 text-center">
                                <button data-toggle="modal" data-target="#add-address" class="custom-btn">{{trans('web.add_address')}}</button>
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Select shipping address modal end --}}

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
                                <button type="submit" class="custom-btn">{{trans('web.add')}}</button>
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

            // Get carts from localStorage
            var carts = JSON.parse(localStorage.getItem("carts"));
            if(carts != null){
                for(var i = 0; i < carts.length; i++){
                    $('#sub_price_'+carts[i].id).text(carts[i].total_price+' {{trans("admin.sr")}}');
                    $('#count_'+carts[i].id).val(carts[i].quantity);
                }
            }

            // Calculate Cart total prices on page load
            var sub_price_total = 0;
            var total = 0;
            var fees = parseFloat('{{$shipping_fees}}');

            if(carts != null){
                for(var i = 0; i < carts.length; i++){
                    var single_price = parseFloat(carts[i].total_price);
                    sub_price_total += parseFloat(single_price);
                }
            }
            
            total = parseFloat(sub_price_total) + fees;
            $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
            $('#total').text(total+' {{trans("admin.sr")}}');

            // Update data on plus click
            $(".plus").click(function(){
                var input_val = parseInt($(this).parent().find(".cart-input").val()) + 1;
                $(this).parent().find(".cart-input").val(input_val);

                // Update sub price
                var cart_id = $(this).data('id');
                var price = parseFloat($(this).data('price'));
                price = price * input_val;
                $('#sub_price_'+cart_id).text(price+' {{trans("admin.sr")}}');

                carts = JSON.parse(localStorage.getItem("carts"));
                for(var i = 0; i < carts.length; i++){
                    if(cart_id == carts[i].id){
                        carts[i].quantity = input_val;
                        carts[i].total_price = price;
                        localStorage.setItem("carts", JSON.stringify(carts));
                        break;
                    }
                }

                // Update totals
                var diff = price / input_val;
                sub_price_total += diff;
                total += diff;

                $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                $('#total').text(total+' {{trans("admin.sr")}}');
            });

            // Update data on minus click
            $(".minus").click(function(){
                if ($(this).parent().find(".cart-input").val() > 1){
                    var input_val = parseInt ($(this).parent().find(".cart-input").val()) - 1;
                    $(this).parent().find(".cart-input").val(input_val);

                    // Update sub price
                    var cart_id = $(this).data('id');
                    var price = parseFloat($(this).data('price'));
                    price = price * input_val;
                    $('#sub_price_'+cart_id).text(price+' {{trans("admin.sr")}}');

                    carts = JSON.parse(localStorage.getItem("carts"));
                    for(var i = 0; i < carts.length; i++){
                        if(cart_id == carts[i].id){
                            console.log('in');
                            carts[i].quantity = input_val;
                            carts[i].total_price = price;
                            localStorage.setItem("carts", JSON.stringify(carts));
                            break;
                        }
                    }

                    // Update totals
                    var diff = price / input_val;
                    sub_price_total -= diff;
                    total -= diff;

                    $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                    $('#total').text(total+' {{trans("admin.sr")}}');
                }
                else{}
            });

            // Delete cart
            $('.remove-icon').click(function(){
                var cart_id = $(this).data('id');
                $(this).parent().parent().remove();

                // Update totals
                sub_price_total = 0;
                total = 0;

                var carts = JSON.parse(localStorage.getItem("carts"));

                if(carts != null){
                    for(var i = 0; i < carts.length; i++){
                        if(carts[i].id == cart_id){
                            carts.splice(i-1, 1);
                            localStorage.setItem("carts", JSON.stringify(carts));
                            break;
                        }
                    }
                }

                for(var i = 0; i < carts.length; i++){
                    var single_price = parseFloat(carts[i].total_price);
                    sub_price_total += parseFloat(single_price);
                }

                total = sub_price_total + fees;
                $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                $('#total').text(total+' {{trans("admin.sr")}}');

            });

            // Store carts to database
            $('#continue').click(function(e){
                e.preventDefault();
                $link = $(this);
                var carts = JSON.parse(localStorage.getItem("carts"));
                $.ajax({
                        url: "{{route('carts.update')}}",
                        type: "PUT",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", carts: carts },
                        complete: function(data){
                            window.location.href = $link.attr('href');
                            localStorage.clear();
                        }
                    });

            });

            //  Get cities of selected country
            // $('#country_id').change(function(){
            //     $.ajax({
            //         url: "{{route('countries.getCities')}}",
            //         type: "POST",
            //         dataType: 'html',
            //         data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
            //         success: function(data){

            //             $('#city_id').html(data);

            //             // Open adding city modal
            //             $(".sub-add-address").click(function () {
            //                 if($(".city-text").text() == '{{trans("web.select_city")}}'){
            //                     $(".city-text").text('{{trans("web.add_city")}}');    
            //                     $('#city_name_ar').prop('required',false);
            //                     $('#city_name_en').prop('required',false);
            //                     $('#city_name_ar').val('');
            //                     $('#city_name_en').val('');
            //                 }
            //                 else{
            //                     $(".city-text").text('{{trans("web.select_city")}}');  
            //                     $('#city_id').val('');
            //                     $('#city_id').prop('required',false);
            //                     $('#city_name_ar').prop('required',true);
            //                     $('#city_name_en').prop('required',true);
            //                 }
                            
            //                 $(".city-add-2").slideToggle("fast");
            //                 $(".city-add").slideToggle("fast");
            //             });
            //         }
            //     });
            // });
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