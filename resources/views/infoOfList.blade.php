@extends('layouts.app')

@section('content')
    <div class="transparent">
        @if(!empty($list))
            <h3>{{$list->pavadinimas}}</h3>
            <p class="list-info">{{$list->aprasymas}}</p>
            <p class="list-info">Created at: {{$list->sukurimo_data}}</p>
            @include('include.messages')
            @if($list->itraukta_vieta->count() > 0)
                <h4>Places in this list:</h4>
                <table class="table table-striped" id="listPlaces">
                    <tr>
                        <th>Title</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($list->itraukta_vieta as $addedPlace)
                        <tr class="data-item">
                            <td>{{$addedPlace->lankytina_vietum->pavadinimas}}</td>
                            <td>{{$addedPlace->lankytina_vietum->adresas}}</td>
                            <td class="listPlacesDesc">{{$addedPlace->aprasymas}}</td>
                            <td><a href="{{ url('infoOfPlace/'.$addedPlace->lankytina_vietum->id.'/') }}">More about this place</a></td>
                            <td><a href="{{ url('/lists/infoOfList/editAddedPlace/'.$addedPlace->id.'/') }}">Change description</a></td>
                            <td><a href="{{ url('/lists/infoOfList/deleteAddedPlace/'.$addedPlace->id.'/') }}">Remove</a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="list-info">There is no places included in this list.</p>
            @endif
        @else
            <p>List do not exists</p>
        @endif

    </div>

@endsection
