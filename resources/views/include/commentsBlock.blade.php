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