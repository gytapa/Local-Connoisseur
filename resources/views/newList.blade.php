@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h3>New list</h3>
        @include('include.messages')
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
    </div>
@endsection
