<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
</head>

<body>
<div class="container" ng-app="myApp" ng-controller="usersCtrl"><br>
    <p class="center">&darr; Update will show up here &darr;</p>
    <div class="row">
        <input type="hidden" ng-model="updateuid">    
        <div class="input-field col s3">
          <input ng-model="updatefn" type="text" class="validate">
        </div>
        <div class="input-field col s3">
          <input ng-model="updateln" type="text" class="validate">
        </div>
        <div class="input-field col s1">
          <input ng-model="updateage" type="text" class="validate">
        </div>
        <div class="input-field col s3">
          <input ng-model="updatebio" type="text" class="validate">
        </div>
        <div class="input-field col s2">
          <a class="waves-effect waves-light btn" ng-click="updateuser()"><i class="material-icons right"></i>update</a>
        </div>
    </div>
   <p><input type="text" ng-model="search" class="form-control" placeholder="Search here..."></p>
    <table class="hoverable bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Bio</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody ng-init="getall()">
         <tr ng-repeat="d in names | filter:search">
        <td>{{ d.uid }}</td>
        <td>{{ d.Firstname }}</td>
        <td>{{ d.Lastname }}</td>
        <td>{{ d.Age }}</td>
        <td>{{ d.Bio }}</td>
        <td><a href="#" ng-click="edituser(d.uid)">Edit</a> | <a href="" ng-click="deleteuser(d.uid)">Delete</a></td>
      </tr>
        </tbody>
    </table>
    
    <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Add new user</h4>
      <div class="row">
        <div class="input-field col s12">
          <input ng-model="fn" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s12">
          <input ng-model="ln" type="text" class="validate">
          <label for="first_name">Last Name</label>
        </div>
        <div class="input-field col s12">
          <input ng-model="age" type="text" class="validate">
          <label for="first_name">Age</label>
        </div>
        <div class="input-field col s12">
          <input ng-model="bio" type="text" class="validate">
          <label for="first_name">Bio</label>
        </div>
        <div class="input-field col s12">
          <a class="waves-effect waves-light btn" ng-click="addnew()"><i class="material-icons right"></i>Add</a> <a class="modal-action modal-close waves-effect waves-light btn"><i class="material-icons right"></i>Close</a>
        </div>
      </div>
    </div>
  </div>
</div>

  

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal1">
      <i class="large material-icons">add</i>
    </a>
</div>

<script>
var app = angular.module('myApp', []);
app.controller('usersCtrl', function($scope, $http) {
    $scope.getall = function(){
        $http.get("getresult.php")
        .success(function (response) {$scope.names = response.records;});
    }
    
    $scope.addnew = function() {
        $http.post('addtodb.php',{'fn' : $scope.fn, 'ln' : $scope.ln, 'age' : $scope.age,'bio' : $scope.bio}
        ).success(function (data, status, headers, config) {
          //alert("Matagumpay na naidagdag");
          Materialize.toast('Matagumpay na naidagdag', 4000);
          $scope.getall();
        });
    }
    
     $scope.deleteuser = function(uid) {  
     var x = confirm("Are you sure to delete this record");
     if(x){
      $http.post('delete.php',{'uid' : uid}).success(function (data, status, headers, config)
      {               
         $scope.getall();
        // alert("Matagumpay na nabura sa listahan.");
          Materialize.toast('Matagumpay na nabura sa listahan', 4000);
          $scope.getall();
        });
      }else{
      }
    } 
    $scope.edituser = function(uid) {
    $http.post('edit.php',{'uid' : uid }
     )      
        .success(function (data, status, headers, config) {    
          
           
            $scope.updateuid          =  data[0]["uid"];
            $scope.updatefn        =   data[0]["Firstname"];
            $scope.updateln        =   data[0]["Lastname"];
            $scope.updateage       =   data[0]["Age"];
            $scope.updatebio    =   data[0]["Bio"];


        })

        .error(function(data, status, headers, config){
           
        });
    }
    
    $scope.updateuser = function() {

        $http.post('update.php', 
                    {
                        'uid'     : $scope.updateuid,
                        'fn'     : $scope.updatefn, 
                        'ln'     : $scope.updateln, 
                        'age'    : $scope.updateage,
                        'bio' : $scope.updatebio
                    }
                  )
                .success(function (data, status, headers, config) {                 
                  $scope.getall();
                //alert("Product has been Updated Successfully");
                Materialize.toast('Matagumpay na nabago', 4000);
                });
    }
});
    
    
$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
    
</script>

</body>
</html>