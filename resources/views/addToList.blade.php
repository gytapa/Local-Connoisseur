@extends('layouts.app')

@section('content')
    <div class="transparent">
        <h3>Add to list</h3>
        @include('include.messages')
        @if(isset($_SESSION['user']))
            @if(count($lists) > 0)
                {!! Form::open(['url' => 'infoOfPlace/addToList/add']) !!}
                {{Form::label('list', 'Select list')}}
              <br>
                <select name="list" class="selectpicker">
                    @foreach($lists as $list)
                        @php
                         echo "<option value=".$list['id'].">".$list['pavadinimas']."</option>";
                         @endphp
                    @endforeach
                </select>
                {{ Form::hidden('pid', $place->id) }}
                 <br>
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description','',['class'=> 'form-control column-width', 'placeholder' => 'Enter your description'])}}
                <br>
                {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
                {!! Form::close() !!}


            @else
                <p>You don't have any lists.</p>
                <a href="{{ url('lists/newList') }}">Click here and create one</a>
            @endif

        @endif
    </div>
@endsection