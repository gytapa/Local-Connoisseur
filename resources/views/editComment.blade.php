@extends ('layouts.app')
@section ('content')
    <div class="transparent">
        <h3>Edit your comment</h3>
        @include('include.messages')
        {!! Form::open(['url' => 'editComment/submit']) !!}
        {{ Form::hidden('cid', $comment->id) }}
        <div class="form-group">
            <br>
            {{Form::text('topic',$comment->tema,['class'=> 'form-control', 'placeholder' =>'Enter topic'])}}
            <br>
            {{Form::textarea('text',$comment->tekstas,['class'=> 'form-control', 'placeholder' => 'Enter comment'])}}
        </div>
        <div>
            {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection