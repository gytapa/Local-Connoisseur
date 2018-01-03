@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h1>My Lists</h1>
        @include('include.messages')
        @if(count($lists)>0)
            <table class="table table-striped" id="clients-table">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created at</th>
                    <th></th>
                    <th></th>

                </tr>
                @foreach($lists as $list)
                    <tr class="data-item">
                        <td>{{$list->pavadinimas}}</td>
                        <td class="column-width">{{$list->aprasymas}}</td>
                        <td>{{$list->sukurimo_data}}</td>
                        <td><a href="{{ url('lists/infoOfList/'.$list->id.'/') }}">More...</a></td>
                        <td><a href="{{ url('lists/deleteList/'.$list->id.'/') }}">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <br/>
        <a href="{{ url('lists/newList') }}">New List</a>
    </div>
@endsection
