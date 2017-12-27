@extends('layouts.app')

@section('content')
    <h1>Information of a place</h1>
    <br/>
    @if(!empty($place))
        <table class="table table-striped" id="empl-table">
            <tr class="data-item">
                <td>
                    Title :
                    {{$place->pavadinimas}}
                </td>
            </tr>
            <tr class="data-item">
                <td>
                    City :
                    {{$place->miestas}}

                </td>
            </tr>
            <tr class="data-item">
                <td>
                    Address :
                    {{$place->adresas}}
                </td>
            </tr>
            <tr class="data-item">
                <td>
                    <!--pakeisiu veliau su js tiesiog,nes toks langas tai neverta :D-->
                    <a href="{{ url('infoOfPlace/visited/'.$place->id.'/') }}">I have visited this place</a>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <h1>Comments</h1>
        <br/>
        {!! Form::open(['url' => 'infoOfPlace/send']) !!}
        {{ Form::hidden('pid', $place->id) }}
        <div class="form-group">
            {{Form::label('comment', 'Comment')}}
            {{Form::textarea('comment','',['class'=> 'form-control', 'placeholder' => 'Enter comment'])}}
        </div>
        <div>
            {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
        <br/>
        <br/>
        @if(count($comments)>0)
            @foreach($comments as $comment)
                <ul class="list-group">
                    <li class="list-group-item">From: {{$comment->user->vardas}} {{$comment->user->pavarde}}</li>
                    <li class="list-group-item">Date: {{$comment->laikas}}</li>
                    <li class="list-group-item">Text: {{$comment->tekstas}}</li>
                    @php
                    $test = 0;
                    @endphp
                    @foreach($comment->komentaro_vertinimas as $evaluation)
                        @php
                        $test += $evaluation->vertinimas
                        @endphp
                    @endforeach
                    <li class="list-group-item">Evaluation: {{$test}}</li>
                    <li class="list-group-item"><a href="{{ url('infoOfPlace/evaluate/'.$comment->id.'/1/'.$place->id.'/') }}">+1</a></li>
                    <li class="list-group-item"><a href="{{ url('infoOfPlace/evaluate/'.$comment->id.'/-1/'.$place->id.'/') }}">-1</a></li>
                </ul>
                <br/>
            @endforeach
        @else
            <p>There is no comments</p>
        @endif
    @endif
@endsection
