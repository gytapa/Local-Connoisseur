@extends ('layouts.app')
@section ('content')
    <div class="transparent">
        <h1>Critics, that need approval by admin</h1>
        @include('include.messages')
        <table class="table" id="confirmUsersTable">
            <tr>
                <th>Critics waiting for confirmation</th>
                <th>Uploaded documents</th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->vardas}} {{$user->pavarde}}</td>
                    <td>
                        @if($user->sertifikatas->count() > 0)
                            @foreach($user->sertifikatas as $certification)
                                <a href="{{ url('userpage/download/'.$certification->pavadinimas.'/') }}">{{$certification->pavadinimas}}</a>
                                <br>
                            @endforeach
                        @endif
                    </td>
                    <td><a href="/confirm/{{$user->id}}">Confirm critic</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

