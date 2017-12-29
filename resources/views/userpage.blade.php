@extends ('layouts.app')
@section ('content')
    @if($_SESSION['user']->role == 0)
        <a href="/confirmusers">Confirm Critics, that ar waiting for validation</a>
    @endif
    <h1>Hello,{{$user->vardas}} {{$user->pavarde}}</h1>
    <h3>City: {{$user->miestas}}</h3>
    <h3>Address: {{$user->adresas}}</h3>
@endsection