@extends ('layouts.app')
@section ('content')
    <div id="search-box">
        <div class="transparent">
            <h2 class="headertekst">Search for a place</h2>
            <p>Look for a place where you could eat</p>
            <div id="search-form-div">
                <form id="search-form" method="get">
                    <div class="Row">
                        <div class="Column" id="city-column">
                            <label id="city-text-label" for="city-text">Select a city</label>
                            <input class="login-register-field" type="text" id="city-text" name="city"
                                   placeholder="Type a city where you would like to eat">
                        </div>
                        <div class="Column" id="or-column">
                            <p>or</p>
                        </div>
                        <div class="Column" id="map-column">
                            <label id="map-label">Select your location in map</label>
                            <input type="hidden" id="latlng" name="latlng" value="">
                            <div id="map"></div>
                        </div>
                    </div>
                    <script>
                        var map, infoWindow, marker;

                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: -34.397, lng: 150.644},
                                zoom: 10
                            });
                            infoWindow = new google.maps.InfoWindow;

                            // Try HTML5 geolocation.
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function (position) {
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };

                                    map.setCenter(pos);
                                    marker = new google.maps.Marker({
                                        position: pos,
                                        map: map
                                    });
                                    var lat = marker.getPosition().lat();
                                    var lng = marker.getPosition().lng();
                                    var loca = document.getElementById("latlng");
                                    loca.value = "location=" + lat + "," + lng;
                                }, function () {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                });
                            } else {
                                // Browser doesn't support Geolocation
                                handleLocationError(false, infoWindow, map.getCenter());
                            }
                            map.addListener('click', function (e) {
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
                    <div class="Row">
                        <div class="Column" id="slidecontainer">
                            <input class="slider" type="range" name="radius" min="10" max="1000" value="50" id="radius"
                                   oninput="this.form.radiusInput.value=this.value">
                        </div>
                        <div class="Column" id="slideInputContainer">
                            <label id="radius-label" for="radius">Radius</label>

                            <input class="radius-field" id="radius-field" type="number" name="radiusInput" min="10"
                                   max="1000" value="50" oninput="this.form.radius.value=this.value"/>
                            <label id="meters" for="meters">meters</label>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Column" id="select-type-column">
                            <select name="options" id="typesPicker" multiple>
                                <option value="cafe">Cafe</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="bar">Bar</option>
                                <option value="meal_takeaway">Meals for takeaway</option>
                                <option value="meal_delivery">Meals for delivery
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="btn_center">
                    <input class="findButton" type="submit" value="Find a Place">
                    </div>
                </form>
            </div>
        </div>
        @if(isset($_GET['city']))
            <div class="foundedPlaces">
                <h3>Found places</h3>
                @include('include.messages')
                @foreach ($places as $place)

                    <div class="floating-box">
                        <div class="row">
                            <div class="col" id="image-column">
                                <div id="image">
                                    <a href="/infoOfPlace/{{$place['id']}}"><img id="list-img" src="{{$place['photo']}}"
                                                                                 alt="No image available"></a>
                                </div>
                            </div>
                            <div class="col" id="infoColumn">
                                <h6 class="card-title"><b>{{$place['name']}}</b></h6>
                                <p class="card-text">{{$place['address']}}</p>
                                <a href="https://www.google.com/maps/search/?api=1&query={{$place['name']}}" class="card-text" target="_blank">Get Directions</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                {{ $klaida or ' ' }}
            </div>
    </div>
@endsection