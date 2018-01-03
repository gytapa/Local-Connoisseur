@extends('layouts.app')
@section('content')
    <div class="transparent">
        <h3>Critics list</h3>
        @include('include.messages')
        @if(isset($critics) && sizeof($critics) > 0)
            <table class="table table-striped" id="critics-table">
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Last seen at</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Is confirmed</th>
                    <th>Block</th>
                </tr>
                @foreach($critics as $critic)
                    <tr class="data-item">
                        <td>{{$critic->el_pastas}}</td>
                        <td>{{$critic->vardas}}</td>
                        <td>{{$critic->pavarde}}</td>
                        <td>{{$critic->paskutinis_prisijungimas}}</td>
                        <td>{{$critic->miestas}}</td>
                        <td>{{$critic->adresas}}</td>
                        @if($critic->ar_patvirtinta == 1)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif
                        @if($critic->blokas->count() > 0)
                            @if(strtotime($critic->blokas->first()->laikas) > strtotime('now'))
                                <td>User is already blocked <a href="{{ url('userlist/unblock/'.$critic->id.'/') }}">Unblock</a></td>
                            @else
                                <td><a href="{{ url('userlist/block/'.$critic->id.'/') }}">Block</a></td>
                            @endif
                        @else
                            <td><a href="{{ url('userlist/block/'.$critic->id.'/') }}">Block</a></td>
                        @endif
                    </tr>
                @endforeach
                @else
                    <p>There are no registered critics in the system</p>
                @endif
            </table>
            <h3>Users list</h3>
            @if(isset($users) && sizeof($users) > 0)
                <table class="table table-striped" id="users-table">
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Last seen at</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Block</th>
                    </tr>
                    @foreach($users as $user)
                        <tr class="data-item">
                            <td>{{$user->el_pastas}}</td>
                            <td>{{$user->vardas}}</td>
                            <td>{{$user->pavarde}}</td>
                            <td>{{$user->paskutinis_prisijungimas}}</td>
                            <td>{{$user->miestas}}</td>
                            <td>{{$user->adresas}}</td>
                            @if($user->blokas->count() > 0)
                                @if(strtotime($user->blokas->first()->laikas) > strtotime('now'))
                                    <td>User is already blocked <a href="{{ url('userlist/unblock/'.$user->id.'/') }}">Unblock</a></td>
                                @else
                                    <td><a href="{{ url('userlist/block/'.$user->id.'/') }}">Block</a></td>
                                @endif
                            @else
                                <td><a href="{{ url('userlist/block/'.$user->id.'/') }}">Block</a></td>
                            @endif
                        </tr>
                    @endforeach
                    @else
                        <p>There are no registered users in the system</p>
                    @endif
                </table>
    </div>
@endsection