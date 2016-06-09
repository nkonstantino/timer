// display ticking clock, takes in a starting time
function timerCounter(hours, minutes, seconds) {
    document.getElementById("startTimerButton").style.display = "none";
    document.getElementById("pauseTimerButton").style.display = "inline-block";
    document.getElementById("submitTimerButton").style.display = "inline-block";
    // funtion that runs every 1000 milliseconds
    onTimeout = function(){
        // increment and display seconds on start
        seconds++;
        document.getElementById("seconds").innerHTML = seconds;
        // check if seconds is greater or equal to 60
        if (seconds >= 6) {
            // set seconds to 0 and display the new value
            seconds = 0;
            document.getElementById("seconds").innerHTML = seconds;
            // increment minutes and display the new minute value 
            minutes++;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("minutesUnits").style.display = "inline-block";
            if(minutes == 1) {
                document.getElementById("minutes").style.display = "inline-block";
                document.getElementById("minutesUnits").innerHTML = "\xa0minute";
            } else { 
                document.getElementById("minutesUnits").innerHTML = "\xa0minutes";
            }
          // check if minutes is greater to or equal to 60
          if(minutes >= 6) {
            // set minutes to 0 and display the new value
            // increment hours and display the new hour value
            minutes = 0;
            hours++;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("hours").style.display = "inline-block";
            document.getElementById("hoursUnits").innerHTML = "\xa0hours";
            if(hours == 1) {
                document.getElementById("hoursUnits").style.display = "inline-block";
                document.getElementById("hoursUnits").innerHTML = "\xa0hour";
            } else { 
                document.getElementById("hoursUnits").innerHTML = "\xa0hours";
            }
          }
        }
        // sets a timeout that runs onTimeout every 1000ms
        // this runs asyncrenously 
        buttonTimeout = setTimeout(function(){ onTimeout() },1000);
    }
    buttonTimeout = setTimeout(function(){ onTimeout() },1000);
}

// pause timer
function pauseTimer() {
    // hide the pause button and show the resume button
    document.getElementById("pauseTimerButton").style.display = "none";
    document.getElementById("resumeTimerButton").style.display = "inline-block";

    clearTimeout(buttonTimeout);
}

// resume paused timer
function resumeTimer() {
    // hide the resume button and show the pause button
    document.getElementById("resumeTimerButton").style.display = "none";
    document.getElementById("pauseTimerButton").style.display = "inline-block";

    buttonTimeout = setTimeout(function(){ onTimeout() },1000);
}

// submits form and clears timer
function submitTime() {
    // pausing the counter
    clearTimeout(buttonTimeout);
    // resetting all of the numbers
    document.getElementById("hours").innerHTML = "";
    document.getElementById("minutes").innerHTML = "";
    document.getElementById("seconds").innerHTML = 0;
    // hiding the units
    document.getElementById("hoursUnits").style.display = "none";
    document.getElementById("minutesUnits").style.display = "none";
    // resetting buttons to only display 'start'
    document.getElementById("startTimerButton").style.display = "inline-block";
    document.getElementById("pauseTimerButton").style.display = "none";
    document.getElementById("submitTimerButton").style.display = "none";
    document.getElementById("resumeTimerButton").style.display = "none";
}

// set the value of start time and end time to current time
function setCurrentTime() {
    var checkDate = new Date();
    document.getElementById("currentDayStart").value = moment(checkDate).format('YYYY-MM-DD');
    document.getElementById("currentDayEnd").value = moment(checkDate).format('YYYY-MM-DD');
    document.getElementById("currentTimeStart").value = moment(checkDate).format('h:mm:ss a');
    document.getElementById("currentTimeEnd").value = moment(checkDate).format('h:mm:ss a');
}

// reading json file
var app = angular.module('timer', []);
app.controller('timerCtrl', function($scope, $http) {
    $http.get("http://localhost:8888/timer/json.php").then(function (response) {
        $scope.timers = response.data
    });
});
