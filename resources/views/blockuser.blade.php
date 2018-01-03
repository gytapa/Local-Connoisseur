@extends('layouts.app')

@section('content')
    <div class="transparent">
        @include('include.messages')
        <h4>Block user: {{$user->pavarde}} {{$user->vardas}}</h4>
        {!! Form::open(['url' => 'userlist/block/submitBlock']) !!}
        {{ Form::hidden('id', $user->id) }}
        <div class="form-group">
            {{Form::label('reason', 'Reason')}}
            {{Form::text('reason','',['class'=> 'form-control', 'placeholder' => 'Enter reason'])}}
            <br>
            {{Form::label('date', 'Date of block expiration')}}
            {{Form::date('date','',['class' => 'form-control'])}}
        </div>
        <div>
            {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
