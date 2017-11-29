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
            <input type="submit" value="Find a Place">
            @unless(is_null($city))
                {{$city}}
                {{$radius}}
            @endunless

        </form>
    </div>
@endsection