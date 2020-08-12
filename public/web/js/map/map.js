
function initMap(){
    
    var lat = localStorage.getItem('lat') ? localStorage.getItem('lat') : 23.885942;
    var lng = localStorage.getItem('lng') ? localStorage.getItem('lng') : 45.079163;

    // Center the map to user current location
    const map = new google.maps.Map(document.getElementById("gmap"), {
      zoom: 10,
      center: { lat: parseFloat(lat), lng: parseFloat(lng) } // Current user location or SA.
    });

    var address_marker = new google.maps.Marker({
        position:  { lat:parseFloat(lat), lng: parseFloat(lng) },
        draggable: true,
        title:"Address Location"
    });

    var teaching_marker = new google.maps.Marker({
        position:  { lat: parseFloat(lat) + 0.08, lng: parseFloat(lng) + 0.08 },
        draggable: true,
        title:"Teaching Address Location"
    });

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

