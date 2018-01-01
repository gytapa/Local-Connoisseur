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
                        <p>Cheap</p>
                        <p>{{$place->adresas}}</p>
                        <p>Get directions</p>
                    </div>
                    <div class="col">
                        <br>
                        <img height="150px" width="400px"
                             src="https://cnet2.cbsistatic.com/img/H_zPLL8-QTZOLxJvgHQ1Jkz0EgY=/830x467/2013/07/10/f0bcef02-67c2-11e3-a665-14feb5ca9861/maps_routemap.png"
                             alt="No image available">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ url('infoOfPlace/visited/'.$place->id.'/') }}">I have visited this place</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="rating">
                            <a href="{{ url('places/evaluate/'.$place->id.'/5/') }}"><span>☆</span></a>
                            <a href="{{ url('places/evaluate/'.$place->id.'/4/') }}"><span>☆</span></a>
                            <a href="{{ url('places/evaluate/'.$place->id.'/3/') }}"><span>☆</span></a>
                            <a href="{{ url('places/evaluate/'.$place->id.'/2/') }}"><span>☆</span></a>
                            <a href="{{ url('places/evaluate/'.$place->id.'/1/') }}"><span>☆</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="comments">
                <div class="container">
                    @if(isset($success))
                        <div class="alert alert-success">
                            {{$success}}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            @include('include.commentcomponent')
                        </div>
                    </div>
                    @if(count($comments)>0)
                        @foreach($comments as $comment)
                            <div class="col comment-column comment-margin">
                                <ul class="list-group">
                                    <li class="list-group-item borderless" id="topic"><b>{{$comment->tema}}</b></li>
                                    <li class="list-group-item borderless"
                                        id="sender">{{$comment->user->vardas}} {{$comment->user->pavarde}}</li>
                                    <li class="list-group-item borderless" id="date">{{$comment->laikas}}</li>
                                    @php
                                        $positive = 0;
                                        $negative = 0;
                                    @endphp
                                    @foreach($comment->komentaro_vertinimas as $evaluation)
                                        @php
                                            if($evaluation->vertinimas == 1){
                                                $positive +=1;
                                            }
                                            else{
                                                $negative +=1;
                                            }
                                        @endphp
                                    @endforeach
                                    <li class="list-group-item borderless" id="evaluation"><span
                                                id="evspan">{{$positive}}</span><a class="upvote"
                                                                                   href="{{ url('infoOfPlace/evaluate/'.$comment->id.'/1/'.$place->id.'/') }}"></a><span
                                                id="evspan">{{$negative}}</span><a class="downvote"
                                                                                   href="{{ url('infoOfPlace/evaluate/'.$comment->id.'/-1/'.$place->id.'/') }}"></a>
                                    </li>
                                    <li class="list-group-item borderless" id="text">{{$comment->tekstas}}</li>
                                    @if(isset($_SESSION['user']) && $_SESSION['user']->id == $comment->fk_VARTOTOJASid)
                                        <li class="list-group-item borderless" id="actions"><a
                                                    href="{{ url('deleteComment/'.$comment->id.'/') }}">Delete</a>&nbsp;&nbsp;&nbsp;<a
                                                    href="{{ url('editComment/'.$comment->id.'/') }}">Edit</a></li>
                                    @elseif(isset($_SESSION['user']) && $_SESSION['user']->role == 0)
                                        <li class="list-group-item borderless" id="actions"><a
                                                    href="{{ url('deleteComment/'.$comment->id.'/') }}">Delete</a></li>
                                    @endif
                                </ul>
                            </div>
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
