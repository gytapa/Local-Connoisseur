@extends ('layouts.app')
@section ('content')
    <h1>Hello,{{$user->vardas}} {{$user->pavarde}}</h1>
    <h3>City: {{$user->miestas}}</h3>
    <h3>Address: {{$user->adresas}}</h3>

@endsection