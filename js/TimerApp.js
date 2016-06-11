var mainApp = angular.module("TimerApp", []);
    mainApp.controller('timerController', function($scope, $http) {
        //GET timer json for manipulation!
        var url = "timer_json.php";
        $http.get(url).success( function(response) {
            $scope.timers = response;
        });
        
    //Timer test
    $scope.count = 0;
    $scope.editTimer = function(val){
        console.log(val);
     };
     
     });
  </script>
  
    <script>
     mainApp.controller('userController', function($scope, $http) {
         var url2 = "user_json.php";
         $http.get(url2).success( function(response) {
             $scope.users = response;
         });
     });