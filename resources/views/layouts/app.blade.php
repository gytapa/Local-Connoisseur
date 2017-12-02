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
        <li>Home</li>
        <li>Search for a place</li>
        <li>About</li>
        <li>Contacts</li>
        <li><button id="login">Log In</button></li>
        <li><button id="register">Register</button> </li>
    </ul>
</div>

@yield('content')

<div id="footer">
    <ul>
        <li>Home</li>
        <li>Search for a place</li>
        <li>About</li>
        <li>Contacts</li>
        <li>Log in</li>
        <li>Register</li>
    </ul>
    <h2>Local Connoisseur</h2>
    <h3>2017</h3>
</div>
</body>
</html>