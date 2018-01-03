<nav class="navbar navbar-expand-lg navbar-color">
    <a class="navbar-brand navbar-item-color" href="#">Local connoisseur</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link navbar-item-color" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-item-color" href="/search">Search for a place</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-item-color" href="/places">Places</a>
            </li>
            @if(isset($_SESSION['user']))
                <li class="nav-item">
                <li><a class="nav-link navbar-item-color" href="/lists">My lists</a></li>
                </li>
                <li class="nav-item">
                <li><a class="nav-link navbar-item-color" href="/visits">My history</a></li>
                </li>
                @endif
                @if(isset($_SESSION['user']) && $_SESSION['user']->role == 0)
                </li>
                <li class="nav-item">
                <li><a class="nav-link navbar-item-color" href="/confirmusers">Confirm critics</a></li>
                <li><a class="nav-link navbar-item-color" href="/userslist">Users</a></li>
                </li>
            @endif

        </ul>
        <ul class="navbar-nav ml-auto">
            @if(isset($_SESSION['user']->vardas))
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/userpage">
                        Sveiki, {{$_SESSION['user']->vardas}}</a></li>
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/logout" id="login">Log Out</a></li>
            @else
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/login" id="login">Log In</a></li>
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/register" id="register">Register</a>
                </li>
            @endif
        </ul>
    </div>
</nav>