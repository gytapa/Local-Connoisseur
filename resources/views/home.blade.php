@extends ('layouts.app')
@section ('content')
<div id="home-message" class="center">
    @include('include.messages')
    <h1>Quickly Find a Place To Eat</h1>
    <p>Use our search engine to find yourself a dining place.
    You can use our filters to find <br>a place that is perfect for your needs of eating.</p>
    <a href="search" id="home-button"><span>Find a Place</span></a>
</div>
@endsection