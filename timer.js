var mainApp = angular.module("TimerApp", []);
mainApp.controller('timerController', function($scope, $http) {
    var url = "timer_json.php";
    $http.get(url).success( function(response) {
        $scope.timers = response;
    });
    $scope.count = 0;
    //EDIT TIMER FUNCTION
    //Moves data from table into form.
    $scope.editTimer = function(T_id,U_id,P_id,S_time,E_time){
        //Fill timer information in!
        $scope.editTID = T_id;
        $scope.editUID = U_id;
        $scope.editPID = P_id;
        //Start Times Conversion
        var SDateTime = new Date(S_time * 1000);
        var SDT = SDateTime;
        var SDate = new Date(SDT.getFullYear(),SDT.getMonth(),SDT.getDate());
        $scope.editSDATE = SDate;
        var STime = new Date(1970,0,1,SDT.getHours(),SDT.getMinutes(),SDT.getSeconds());
        $scope.editSTIME = STime;
        
        //End Times Conversion
        var EDateTime = new Date(E_time * 1000);
        var EDT = EDateTime;
        var EDate = new Date(EDT.getFullYear(),EDT.getMonth(),EDT.getDate());
        $scope.editEDATE = EDate;
        var ETime = new Date(1970,0,1,EDT.getHours(),EDT.getMinutes(),EDT.getSeconds());
        $scope.editETIME = ETime;
     };
    //SUBMIT EDIT FUNCTION
    //Moves data from form into database.
    $scope.submitEdit = function(){
        var editRequest = $http({
            method: "post",
            url: "timer_actions.php",
            data: {
                action: "Edit",
                TID: $scope.editTID,
                UID: $scope.editUID,
                PID: $scope.editPID,
                SDATE: $scope.editSDATE,
                STIME: $scope.editSTIME
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        //post request, everything in form into an array/json thing.
        editRequest.success(function (response){
          console.log(response);  
        });
    };
    
    //SUBMIT ADD FUNCTION
    //Adds data from form into database.
    $scope.submitAdd = function(){
        console.log("Timer Added");
    };
});