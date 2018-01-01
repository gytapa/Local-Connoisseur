@extends ('layouts.app')
@section ('content')
    <div ng-dropdown-multiselect="" options="example2data" selected-model="example2model" extra-settings="example2settings"></div>
    <script>
        $scope.example2model = [];
        $scope.example2data = [ {id: 1, label: "David"}, {id: 2, label: "Jhon"}, {id: 3, label: "Danny"}];
        $scope.example2settings = {displayProp: 'id'};
    </script>
@endsection

