<!DOCTYPE html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Connoisseur</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
<div id="container">
    <div id="header">
        @include('include.navbar')
    </div>
    <div id="content">
        @yield('content')
    </div>
    <div class="footer">
        @include('include.footernavbar')
        <h5 class="footer-element">Local Connoisseur</h5>
        <h6 class="footer-element">2017</h6>
    </div>
</div>
</body>
</html>