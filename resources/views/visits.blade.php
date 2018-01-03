@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h1>Visited places</h1>
        @include('include.messages')
        @if(count($visitedPlaces)>0)
            <table class="table table-striped" id="visitedPlaces-table">
                <tr>
                    <th>Title</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Comment</th>
                </tr>
                @foreach($visitedPlaces as $place)
                    <tr class="data-item">
                        <td>{{$place->lankytina_vietum->pavadinimas}}</td>
                        <td>{{$place->lankytina_vietum->adresas}}</td>
                        <td>{{$place->data}}</td>
                        <td class="column-width">{{$place->komentaras}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection