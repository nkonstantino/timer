<html>
   
   <head>
      <title>Angular JS Filters</title>
      <script src = "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   </head>
   
   <body>
      <h2>AngularJS Sample Application</h2>
      <div ng-app = "TimerApp" ng-controller = "timerController">
         <br/>
         <table>
           <tr>
            <th>Timer ID</th>
            <th>User ID</th>
            <th>Project ID</th>
            <th>Start Date</th>
            <th>Start Time</th>
            <th>End Date</th>
            <th>End Time</th>
            <th>Total Time</th>   
           </tr>
            <tr ng-repeat="t in timers | orderBy:'S_time'">
               <td>{{ t.T_id }}</td>
               <td>{{ t.U_id }}</td>
               <td>{{ t.P_id }}</td>
               <td>{{ t.S_time *1000 | date:'MM-dd-yyyy'}}</td>
               <td>{{ t.S_time *1000 | date:'HH:mm:ss'}}</td>
               <td>{{ t.E_time *1000 | date:'MM-dd-yyyy'}}</td>
               <td>{{ t.E_time *1000 | date:'HH:mm:ss'}}</td>
               <td>{{ t.T_time }}</td>
               <td></td>
           </tr>	
         </table>
         
      </div>

    <script>
     var mainApp = angular.module("TimerApp", []);
     mainApp.controller('timerController', function($scope, $http) {
         var url = "timer_json.php";
         $http.get(url).success( function(response) {
             $scope.timers = response;
         });
     });
  </script>
  
    <script>
     mainApp.controller('userController', function($scope, $http) {
         var url2 = "user_json.php";
         $http.get(url2).success( function(response) {
             $scope.users = response;
         });
     });
  </script>
   </body>
</html>