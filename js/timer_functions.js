var app = angular.module('timer', []);
app.controller('timerCtrl', function($scope, $http) {
    $http.get("http://localhost:8888/timer/json.php").then(function (response) {$scope.timers = response.data});
    $scope.timers = [];
    $scope.test = "test";
    function timerCounter($scope) {
        $scope.hours = 0;
        $scope.minutes = 0;
        $scope.seconds = 0;
        $scope.onTimeout = function(){
            $scope.seconds++;
            if ($scope.seconds >= 3) {
                $scope.seconds = 0;
                $scope.minutes++;
                document.getElementById("minutes").style.display = "inline-block";
              if($scope.minutes >= 3) {
                $scope.minutes = 0;
                $scope.hours++;
                document.getElementById("hours").style.display = "inline-block";
              }
            }
            if($scope.minutes > 0 && $scope.hours == 0){
                document.getElementById("units").innerHTML = "minutes";
            } else if($scope.hours != 0) {
                document.getElementById("units").innerHTML = "hours";
            }
            mytimeout = $timeout($scope.onTimeout,1000);
        }
        var mytimeout = $timeout($scope.onTimeout,1000);
        
        $scope.stop = function(){
            $timeout.cancel(mytimeout);
        }          
    }
});