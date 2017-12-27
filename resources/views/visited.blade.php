@extends('layouts.app')

@section('content')
    {!! Form::open(['url' => 'infoOfPlace/submitVisited']) !!}
    {{ Form::hidden('pid', $pid) }}
    <div class="form-group">
        {{Form::label('comment', 'Comment')}}

        {{Form::textarea('comment','',['class'=> 'form-control', 'placeholder' => 'Enter comment about your experience in this place'])}}
    </div>
    <div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
    <br/>
    <br/>
@endsection
