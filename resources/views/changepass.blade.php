@extends ('layouts.app')
@section ('content')
    <div class="transparent">


        <h1>Hello,{{$user->vardas}} {{$user->pavarde}}</h1>
        <h3>City: {{$user->miestas}}</h3>
        <h3>Address: {{$user->adresas}}</h3>

        <form method="post" action="">

            <div class="center" id="test1">
                @if(isset($message))
                    <div class="alert alert-info">
                        {{$message}}
                    </div>
                @endif
                <div class="form-group">
                    <label for="password1">Current password</label>
                    <input id="password1" class="login-register-field" name="password" type="password" placeholder="Your Current Password">
                </div>

                <div class="form-group">
                    <label for="newpass">New Password</label>
                    <input id="newpass" class="login-register-field" name="newpass" type="password" placeholder="Your new Password">
                </div>

                <div class="form-group">
                    <label for="newpass">Repeat New Password</label>
                    <input id="newpass2" class="login-register-field" name="newpass2" type="password" placeholder="Repeat Your new Password">
                </div>

                <div class="btn_center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="submit" type="submit" class="btn btn-primary">Change</button>
                </div>
            </div>
        </form>


@endsection