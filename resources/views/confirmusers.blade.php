@extends ('layouts.app')
@section ('content')
    <h1>Critics, that need approval by admin</h1>
    @if(isset($_SESSION['message']))
        <div class="alert alert-success">
            {{$_SESSION['message']}}
            @unset($_SESSION['message'])
        </div>
    @endif
        @foreach($users as $user)
            @if($user->ar_patvirtinta == 0)
            <p>{{$user->vardas}} {{$user->pavarde}}
                <a href="/confirm/{{$user->id}}">Confirm critic</a>
            </p>
            @endif
            @endforeach
    @endsection

