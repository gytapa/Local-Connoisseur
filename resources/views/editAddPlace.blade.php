@extends('layouts.app')
@section('content')
    <div class="transparent">
        <h3>Edit description about {{$addedPlace->lankytina_vietum->pavadinimas}} at list {{$addedPlace->sarasa->pavadinimas}}</h3>
        @include('include.messages')
        {!! Form::open(['url' => 'lists/infoOfList/submitNewPlaceDesc']) !!}
        {{ Form::hidden('id', $addedPlace->id) }}
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description',$addedPlace->aprasymas,['class'=> 'form-control', 'placeholder' => 'Enter description of this place'])}}
        </div>
        <div>
            {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
