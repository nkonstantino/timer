<html>
   
   <head>
      <title>Angular JS Filters</title>
      <script src = "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   </head>
   
   <body>
      <h2>AngularJS Sample Application</h2>
      <div ng-app = "mainApp" ng-controller = "timerController">
         <br/>
         <table>
           <tr>
            <th>Timer ID</th>
            <th>User ID</th>
            <th>Project ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Total Time</th>   
           </tr>
            <tr ng-repeat="t in chronos.timers | orderBy:'S_time'">
               <td>{{ t.T_id }}</td>
               <td>{{ t.U_id }}</td>
               <td>{{ t.P_id }}</td>
               <td>{{ t.S_time }}</td>
               <td>{{ t.E_time }}</td>
               <td>{{ t.T_time }}</td>
               <td></td>
           </tr>	
         </table>
         
      </div>
      
<!--
  <script>
     var mainApp = angular.module("mainApp", []);
     mainApp.controller('timerController', function($scope) {
        $scope.chronos = {            
           timers:[
           {"T_id":"1","P_id":"1","S_time":"1464328401","E_time":"1464328536","T_time":"0","U_id":"1"},{"T_id":"7","P_id":"2","S_time":"1464681698","E_time":"1464683778","T_time":"0","U_id":"2"},{"T_id":"8","P_id":"2","S_time":"1464685372","E_time":"1464685506","T_time":"0","U_id":"2"},{"T_id":"9","P_id":"2","S_time":"1464685508","E_time":"1464693080","T_time":"7572","U_id":"2"},{"T_id":"10","P_id":"3","S_time":"1464760287","E_time":"1464763029","T_time":"2742","U_id":"3"},{"T_id":"11","P_id":"3","S_time":"1464861600","E_time":"1464872400","T_time":"10800","U_id":"4"},{"T_id":"12","P_id":"4","S_time":"1464861600","E_time":"1464872400","T_time":"10800","U_id":"4"},{"T_id":"13","P_id":"5","S_time":"1464861600","E_time":"1464861660","T_time":"60","U_id":"2"}
           ]
        };
     });
  </script>
-->
    <script>
     var mainApp = angular.module("mainApp", []);
     mainApp.controller('timerController', function($scope, $http) {
         var url = "test.php";
         $http.get(url).success( function(response) {
             $scope.chronos = response;
         });
     });
  </script>
   </body>
</html>