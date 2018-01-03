@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h4>{{$name}}</h4>
        @include('include.messages')
    {!! Form::open(['url' => 'infoOfPlace/submitVisited']) !!}
    {{ Form::hidden('pid', $pid) }}
    <div class="form-group">
        {{Form::label('comment', 'Comment')}}

        {{Form::textarea('comment','',['class'=> 'form-control', 'placeholder' => 'Enter comment about your experience in this place'])}}
        <br>
        {{Form::label('date', 'Date of visit')}}
        {{Form::date('date','',['class' => 'form-control'])}}
    </div>
    <div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
    </div>
@endsection
