@extends('layouts.app')

@section('content')
    {!! Form::open(['url' => 'lists/submitNewList']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title','',['class'=> 'form-control', 'placeholder' => 'Enter title'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description','',['class'=> 'form-control', 'placeholder' => 'Enter description of this list'])}}
    </div>
    <div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
    <br/>
    <br/>
@endsection
