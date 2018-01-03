@extends('layouts.app')

@section('content')
    <div class="white">
        @if(!empty($place))
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img id="list-img" src="{{$place['nuotrauka']}}"
                             alt="No image available">
                    </div>
                    <div class="col align-left">
                        <h3>{{$place->pavadinimas}}</h3>
                        @php
                            $suma = 0;

                        foreach($place->vietos_vertinimas as $evaluation)
                                $suma += $evaluation->vertinimas;
                        $result = 0;
                        if($suma > 0)
                        $result = $suma/$place->vietos_vertinimas->count();
                        $result = number_format((float)$result, 2, '.', '');
                        @endphp
                        <p>{{$result}}/5.00 <span class="blue">&#9733;</span></p>
                        <p>{{$place->adresas}}</p>
                        <a href="https://www.google.com/maps/search/?api=1&query={{$place['pavadinimas']}}"
                           class="card-text" target="_blank">Get Directions</a>
                    </div>
                    <div class="col">
                        <br>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ url('infoOfPlace/visited/'.$place->id.'/') }}">I have visited this place</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ url('infoOfPlace/addToList/'.$place->id.'/') }}">Add to list</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="rating">
                            <a id="star" href="{{ url('places/evaluate/'.$place->id.'/5/') }}"><span>☆</span></a>
                            <a id="star" href="{{ url('places/evaluate/'.$place->id.'/4/') }}"><span>☆</span></a>
                            <a id="star" href="{{ url('places/evaluate/'.$place->id.'/3/') }}"><span>☆</span></a>
                            <a id="star" href="{{ url('places/evaluate/'.$place->id.'/2/') }}"><span>☆</span></a>
                            <a id="star" href="{{ url('places/evaluate/'.$place->id.'/1/') }}"><span>☆</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="comments">
                <div class="container">
                    @include('include.messages')
                    <div class="row">
                        <div class="col">
                            @include('include.commentcomponent')
                        </div>
                    </div>
                    @if(count($comments)>0)
                        <p id="commentsSplit">Critics reviews</p>
                        @foreach($comments as $comment)
                            @if($comment->user->ar_patvirtinta)
                                @include('include.commentsBlock')
                            @endif
                        @endforeach
                        <p id="commentsSplit">Users reviews</p>
                        @foreach($comments as $comment)
                            @if(!$comment->user->ar_patvirtinta)
                                @include('include.commentsBlock')
                            @endif
                        @endforeach
                    @else
                        <div class="col comment-margin">
                            <p>There is no comments at the moment.</p>
                        </div>
                    @endif
                </div>

            </div>

        @endif
    </div>
@endsection
