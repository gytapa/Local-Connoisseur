<div id="messages">
    @if(isset($_SESSION['success']))
        <div class="alert alert-success">
            {{$_SESSION['success']}}
            @unset($_SESSION['success'])
        </div>
    @endif

    @if(isset($_SESSION['warning']))
        <div class="alert alert-warning">
            {{$_SESSION['warning']}}
            @unset($_SESSION['warning'])
        </div>
    @endif

    @if(isset($_SESSION['danger']))
        <div class="alert alert-danger">
            {{$_SESSION['danger']}}
            @unset($_SESSION['danger'])
        </div>
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
</div>