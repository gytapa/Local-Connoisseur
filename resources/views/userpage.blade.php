@extends ('layouts.app')
@section ('content')
    <div class="transparent">
        @if($_SESSION['user']->role == 1)
            @if($_SESSION['user']->ar_patvirtinta == 0)
                @if(count($certification)>0)
                    <div class="alert alert-warning">
                        <p>Your status as a critic still waiting for approval. Please add your certificate and/or other
                            documents in order to accelare the procces. If u already did that please be patient.</p>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <p>In order to be approved as a critic you need to upload at least one document proving your
                            status.</p>
                    </div>
                @endif
                <a href="/userpage/addDocument">Add document</a>
            @else
                <div class="alert alert-success">
                    <p>Your status as a critic is approved.</p>
                </div>
            @endif
        @endif

        <h1>Hello,{{$user->vardas}} {{$user->pavarde}}</h1>
        <h3>City: {{$user->miestas}}</h3>
        <h3>Address: {{$user->adresas}}</h3>
            <a href="/changepass">Change your password</a>
        @include('include.messages')
        @if($_SESSION['user']->role == 1 && count($certification)>0)
            <table class="table" id="documentsTable">
                <tr>
                    <th>Documents</th>
                </tr>
                @foreach($certification as $item)
                    <tr>
                        <td><a href="{{ url('userpage/download/'.$item->pavadinimas.'/') }}">{{$item->pavadinimas}}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>


@endsection