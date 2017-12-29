@extends('layouts.app')
@section('content')
    <h1>Places</h1>
    <br/>
    @if(count($places)>0)
        <table class="table table-striped" id="clients-table">
            <tr>
                <th>Title</th>
                <th>City</th>
                <th>Address</th>
                <th>Evaluation</th>
                <th></th>
                <th></th>
                <th></th>

            </tr>
            @foreach($places as $place)
                <tr class="data-item">
                    <td>{{$place->pavadinimas}}</td>
                    <td>{{$place->miestas}}</td>
                    <td>{{$place->adresas}}</td>
                    @php
                        $test = 0;
                    @endphp
                    @foreach($place->vietos_vertinimas as $evaluation)
                        @php
                            $test += $evaluation->vertinimas
                        @endphp
                    @endforeach
                    <td>{{$test}}</td>
                    <td><a href="{{ url('infoOfPlace/'.$place->id.'/') }}">More...</a></td>
                    <td><a href="{{ url('places/evaluate/'.$place->id.'/1/') }}">+1</a></td>
                    <td><a href="{{ url('places/evaluate/'.$place->id.'/-1/') }}">-1</a></td>

                </tr>
            @endforeach
        </table>
    @endif
    <br/>
@endsection
