@extends('layouts.app')
@section('content')
    <div class="transparent">
        <h1>Places</h1>
        @include('include.messages')
        @if(count($places)>0)
            <table class="table table-striped" id="critics-table">
                <tr>
                    <th>Title</th>
                    <th>Address</th>
                    <th>Evaluation</th>
                    <th></th>

                </tr>
                @foreach($places as $place)
                    <tr class="data-item">
                        <td>{{$place->pavadinimas}}</td>
                        <td>{{$place->adresas}}</td>
                        <td><a href="{{ url('infoOfPlace/'.$place->id.'/') }}">More...</a></td>

                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
