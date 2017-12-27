
<!DOCTYPE html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Connoisseur</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
<div>
    <ul>
        <li>Logo</li>
        <li><a href="/home">Home</a></li>
        <li><a href="/search">Search for a place</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/contacts">Contacts</a></li>
        <li><a href="/places">Places</a></li>
        @if(isset($_SESSION['user']->vardas))
            <li><a href="/userpage"> Sveiki, {{$_SESSION['user']->vardas}}</a></li>
            <li><a href="/login" id="login">Log Out</a></li>
            @else
            <li><a href="/login" id="login">Log In</a></li>
            <li><a href="/register" id="register">Register</a> </li>

        @endif

    </ul>
</div>

@yield('content')

<div id="footer">
    <ul>
        <li>Logo</li>
        <li><a href="/home">Home</a></li>
        <li><a href="/search">Search for a place</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/contacts">Contacts</a></li>
        <li><a href="/places">Places</a></li>
        @if(isset($_SESSION['user']->vardas))
            <li><a href="/userpage"> Sveiki, {{$_SESSION['user']->vardas}}</a></li>
            <li><a href="/logout" id="login">Log Out</a></li>
        @else
            <li><a href="/login" id="login">Log In</a></li>
            <li><a href="/register" id="register">Register</a> </li>

        @endif
    </ul>
    <h2>Local Connoisseur</h2>
    <h3>2017</h3>
</div>
</body>
</html>