@extends ('layouts.app')
@section ('content')
    <form method="post" action="">
        <div class="form-group">
            <label id="typeLabel" for="type">Select your account type</label>
            <select name="type" id="type">
                <option value="1">Food Critic</option>
                <option value="2">User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" placeholder="Your Email">
            @if(isset($yra))
                <div class="alert alert-warning">
                    This email is already in use
                </div>
            @endif
            @if (array_key_exists('email', $errors))
            <div class="alert alert-warning">
          Bad Email Address
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input id="firstname" name="firstname" type="text" placeholder="Your First Name">
            @if (array_key_exists('firstname', $errors))
                <div class="alert alert-warning">
                    No first name entered
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input id="lastname" name="lastname" type="text" placeholder="Your Last Name">
            @if (array_key_exists('lasttname', $errors))
                <div class="alert alert-warning">
                    No last name entered
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" id="city" type="text" placeholder="Your city">
            @if (array_key_exists('city', $errors))
                <div class="alert alert-warning">
                    No city entered
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input id="address" name="address" type="text" placeholder="Your address">
            @if (array_key_exists('address', $errors))
                <div class="alert alert-warning">
                    No address entered
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password1">Password</label>
            <input id="password1" name="password1" type="password" placeholder="Your Password">
            @if (array_key_exists('password1', $errors))
                <div class="alert alert-warning">
                    Bad password
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password2">Repeat Password</label>
            <input id="password2" name="password2" type="password" placeholder="Repeat Your Password">
            @if (array_key_exists('password2', $errors))
                <div class="alert alert-warning">
                    password does not match
                </div>
            @endif
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection