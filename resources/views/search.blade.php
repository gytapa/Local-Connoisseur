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
            <p>***Tures but zemelapis***</p>
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
                        <img width="300px" src="{{$place['photo']}}" alt="Card image cap">
                        <h6 class="card-title">{{$place['name']}}</h6>
                        <p class="card-text">{{$place['address']}}</p>
                        <p class="card-text">Get Directions</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection