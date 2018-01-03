<div ng-app="myApp" ng-controller="myCtrl">

    <div class="btn_right">
        <button id="review-btn" ng-click="myFunc()">WRITE A REVIEW</button>
    </div>
    <div ng-show="showMe">
        @if(isset($_SESSION['user']))
            {!! Form::open(['url' => 'infoOfPlace/send']) !!}
            {{ Form::hidden('pid', $place->id) }}
            <div class="form-group">
                <br>
                {{Form::text('topic','',['class'=> 'form-control', 'placeholder' =>'Enter topic'])}}
                <br>
                {{Form::textarea('comment','',['class'=> 'form-control', 'placeholder' => 'Enter comment'])}}
            </div>
            <div>
                {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        @else
            <p>You need to login to write a review.</p>
        @endif
    </div>

</div>
<script>

    var app = angular.module('myApp', []);
    app.controller('myCtrl', function ($scope) {
        $scope.showMe = false;
        $scope.myFunc = function () {
            $scope.showMe = !$scope.showMe;

        }
    });

</script>

