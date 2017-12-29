@extends ('layouts.app')
@section ('content')
    <form method="post" action="">
        <div class="center" id="test1">
        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" placeholder="Your Email">
            @if(isset($email))
                <div class="alert alert-warning">
                    {{$email}}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="password1">Password</label>
            <input id="password1" name="password" type="password" placeholder="Your Password">
                @if(isset($password))
                    <div class="alert alert-warning">
                        {{$password}}
                    </div>
                @endif
        </div>

        <div class="btn_center">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button id="submit" type="submit" class="btn btn-primary">Log in</button>
        </div>
        </div>
    </form>
@endsection