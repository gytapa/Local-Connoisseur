@extends ('layouts.app')
@section ('content')
    <h1>You have successfully Logged in</h1>
    <h2>Welcome, {{$_SESSION['user']->vardas}}</h2>
    <a href="/home">Go back to home</a>
@endsection