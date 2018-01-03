@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h3>Add Document</h3>
        @include('include.messages')
        @if(isset($_SESSION['user']) && $_SESSION['user']->role == 1 && $_SESSION['user']->ar_patvirtinta == 0)
            {!! Form::open( [ 'url' =>  'userpage/addDocument/submit' , 'method' => 'post', 'files' => true ] ) !!}
            {{Form::label('file', 'Upload file')}}
            <br>
            {{Form::file('uploadedFile')}}
            <br>
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description','',['class'=> 'form-control column-width', 'placeholder' => 'Enter your description'])}}
            <br>
            {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
            {!! Form::close() !!}
        @endif
    </div>
@endsection