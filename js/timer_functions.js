function test(value) {
    console.log(value);
}

// function to calc total time based on given start and end times and dates
// takes in 4 IDs for the 4 elements that have the start times and dates
// also takes in 1 ID for an element where the total time will be displayed
function calcTotalTime(startTimeId, startDateId, endTimeId, endDateId, displayId) {
    // get all values from the modal
    startTime = document.getElementById(startTimeId).value;
    startDate = document.getElementById(startDateId).value;
    endTime = document.getElementById(endTimeId).value;
    endDate = document.getElementById(endDateId).value;
    
    // remove the am / pm of the time
    startTime = startTime.substring(0, startTime.length - 3);
    endTime = endTime.substring(0, endTime.length - 3);

    // convert tiems to dates
    startDate = new Date(startDate + "T" + startTime);
    endDate = new Date(endDate + "T" + endTime)

    // subtract two dates to get time in milliseconds
    var totalTime = Math.abs(endDate - startDate); 

    // convert milliseconds to hours, minutes, seconds format
    hours = Math.floor(totalTime / 1000 / 60 / 60);
    minutes = Math.floor((totalTime / 1000 / 60) - (hours * 60));
    seconds = Math.floor(totalTime / 1000 / 60 / 60);

    //displaying total time in the given element with the given ID
    document.getElementById(displayId).innerHTML = hours + " hours " + minutes + " minutes " + seconds + " seconds ";
}

$(".dropdown-menu li a").click(function(){
  var selText = $(this).text();
  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
});

function setTimerDisplayProject(targetId, value) {
    document.getElementById(targetId).innerHTML = value;
}

function setProjectId(targetId, value) {
    document.getElementById(targetId).innerHTML = value + " <span class='caret'></span>";
}

// display ticking clock, takes in a starting time
function timerCounter(hours, minutes, seconds) {
    $("#startTimerButton").css("display", "none");
    $("#pauseTimerButton").css("display", "inline-block");
    $("#submitTimerButton").css("display", "inline-block");
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
                document.getElementById("minutesUnits").innerHTML = "\xa0minute and ";
            } else { 
                document.getElementById("minutesUnits").innerHTML = "\xa0minutes and ";
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
    document.getElementById("currentTimeStart").value = moment(checkDate).format('hh:mm:ss a');
    document.getElementById("currentTimeEnd").value = moment(checkDate).format('hh:mm:ss a');
}

function setModalCurrentTime() {
    var checkDate = new Date();
    document.getElementById("modalStartDate").value = moment(checkDate).format('YYYY-MM-DD');
    document.getElementById("modalEndDate").value = moment(checkDate).format('YYYY-MM-DD');
    document.getElementById("modalStartTime").value = moment(checkDate).format('hh:mm:ss a');
    document.getElementById("modalEndTime").value = moment(checkDate).format('hh:mm:ss a');
}

function totalTime() {
    startTime = document.getElementById("modalCurrentTimeStart").value;
    endTime = document.getElementById("modalCurrentTimeEnd").value;
    totalTime = endTime - startTime;
    return totalTime;
}

// reading json file
var app = angular.module('timer', []);
app.controller('timerCtrl', function($scope, $http) {
    $http.get("http://localhost:8888/timer/test.php").then(function (response) {
        $scope.timers = response.data
    });
    $scope.today = new Date();
});

app.filter('moment', function () {
  return function (input, momentFn /*, param1, param2, ...param n */) {
    var args = Array.prototype.slice.call(arguments, 2),
        momentObj = moment(input);
    return momentObj[momentFn].apply(momentObj, args);
  };
});

app.filter("dateFilter", function () {
    return function (item) {
        if (item != null) {
            return new Date(parseInt(item.substr(6)));
        }
        return "";
    };
});