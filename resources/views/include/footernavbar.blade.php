<nav class="navbar navbar-expand-lg footernavbar-color">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mc-auto center">
            <li class="nav-item active">
                <a class="nav-link navbar-item-color" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-item-color" href="/search">Search for a place</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-item-color" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-item-color" href="/contacts">Contacts</a>
            </li>
            @if(isset($_SESSION['user']->vardas))
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/login" id="/logout">Log Out</a></li>
            @else
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/login" id="login">Log In</a></li>
                <li class="nav-item"><a class="nav-link navbar-item-color" href="/register" id="register">Register</a> </li>
            @endif
        </ul>
    </div>
</nav>