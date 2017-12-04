@extends ('layouts.app')
@section ('content')
    <div id="search-box">
        <h1>Search for a place</h1>
        <p>Look for a place where you could eat</p>
        <form id="search-form" method="get">
            <label id="city-text-label" for="city-text">Select a city</label>
            <input type="text" id="city-text" name="city" placeholder="Type a city where you would like to eat">
            <p>or</p>
            <label id="map-label">Select your location in map</label>
            <input type="hidden" id="latlng" name="latlng" value="">
            <div id="map"></div>
            <script>
                var map, infoWindow,marker;

                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -34.397, lng: 150.644},
                        zoom: 10
                    });
                    infoWindow = new google.maps.InfoWindow;

                    // Try HTML5 geolocation.
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };

                            map.setCenter(pos);
                            marker = new google.maps.Marker({
                                position: pos,
                                map: map
                            });
                        }, function() {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                    map.addListener('click', function(e) {
                        placeMarker(e.latLng, map);
                    });

                    function placeMarker(position, map) {


                        var lat = marker.getPosition().lat();
                        var lng = marker.getPosition().lng();
                        var loca = document.getElementById("latlng");
                        loca.value = "location=" + lat + "," + lng;
                        marker.setPosition(position);
                        map.panTo(position);
                    }
                }

            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvn1wIzMafMvflltBY3oZhPf_FyTRrO4s&callback=initMap">
            </script>
            <div id="slidecontainer">
                <label id="radius-label" for="radius">Radius</label>
                <input type="range" name="radius" min="10" max="1000" value="50" id="radius">
            </div>
            <select name="options[]" class="selectpicker" multiple>
                <option value="cafe">Cafe</option>
                <option value="restaurant">Restaurant</option>
                <option value="bar">Bar</option>
                <option value="meal_takeaway">Meals for takeaway</option>
                <option value="meal_delivery">Meals for delivery
                </option>
            </select>
            <input type="submit" value="Find a Place">
        </form>
        @if(isset($_GET['city']))
            <h1>Found places</h1>
            @foreach ($places as $place)
                <div class="card w-75">
                    <div class="card-block">
                        <img width="300px" src="{{$place['photo']}}" alt="No image available">
                        <h6 class="card-title">{{$place['name']}}</h6>
                        <p class="card-text">{{$place['address']}}</p>
                        <p class="card-text">Get Directions</p>
                    </div>
                </div>
            @endforeach
        @endif
        {{ $klaida or 'empty string' }}
    </div>
@endsection