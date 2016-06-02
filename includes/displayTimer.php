<?php include("../includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("../includes/top_nav.php"); ?>
    <?php include("../includes/side_nav.php"); ?>
</nav>
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Admin Home </h1>
            <h1>
                <span id="hours"></span>
                <span id="minutes"></span>
                <span id="seconds"></span> 
                <span id="units">sec</span>
            </h1>
            <script>   
                // display ticking clock, takes in a starting time
                function timerCounter(hours, minutes, seconds) {
                    // funtion that runs every 1000 milliseconds
                    onTimeout = function(){
                        // increment and display seconds on start
                        seconds++;
                        document.getElementById("seconds").innerHTML = seconds;
                        // check if seconds is greater or equal to 60
                        if (seconds >= 6) {
                            // set seconds to 0 and display the new value
                            // increment minutes and display the new minute value 
                            seconds = 0;
                            document.getElementById("seconds").innerHTML = seconds;
                            minutes++;
                            document.getElementById("minutes").innerHTML = minutes;
                            document.getElementById("minutes").style.display = "inline-block";
                          // check if minutes is greater to or equal to 60
                          if(minutes >= 6) {
                            // set minutes to 0 and display the new value
                            // increment hours and display the new hour value
                            minutes = 0;
                            hours++;
                            document.getElementById("minutes").innerHTML = minutes;
                            document.getElementById("hours").innerHTML = hours;
                            document.getElementById("hours").style.display = "inline-block";
                          }
                        }
                        // changes unites to show minutes if time is > 60s
                        // and shows hours if time is > 60m
                        if(minutes > 0 && hours == 0){
                            document.getElementById("units").innerHTML = "minutes";
                        } else if(hours != 0) {
                            document.getElementById("units").innerHTML = "hours";
                        }
                        // sets a timeout that runs onTimeout every 1000ms
                        // this runs asyncrenously 
                        setTimeout(function(){ onTimeout() },1000);
                    }
                    setTimeout(function(){ onTimeout() },1000);
                    // stop = function(){ 
                    //     $timeout.cancel(mytimeout);
                    // }          
                }
                timerCounter(0,0,0);
            </script>
            <button class="btn" ng-click="stop()">Stop</button>
            <button class="btn" onClick='timerCounter();'>test</button>
        </div>

        <div class="col-lg-12">
            <!-- crate a time drop down -->
            <h4>Create a Time:</h4>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Project ID
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" ng-repeat="timer in timers">
                    <li>{{ timer.P_id }}</li>
                </ul>
            </div>
            <!-- get start time -->
            <input type="text" placeholder="Start Time">
            <!-- get end time -->
            <input type="text" placeholder="End Time">
            <!-- TODO display total time -->
            <input type="text" placeholder="userID">
            <button class="btn">Save</button>
        </div>

        <div class="col-lg-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Project ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Time</th>
                    <th>User ID</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tr ng-repeat="timer in timers">
                    <td>{{ timer.P_id }}</td>
                    <td>{{ timer.S_time }}</td>
                    <td>{{ timer.E_time }}</td>
                    <td>{{ timer.T_time }}</td>
                    <td>{{ timer.U_id }}</td>
                    <td><button class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit</button></td>
                    <td><button class="btn btn-success">Resume</button></td>
                    <td><button class="btn btn-warning" data-toggle="modal" data-target="#deleteModal">Delete</button></td>
                </tr>
            </table>

            <div data-ng-model="timerCounter">
                test
                {{ hours }}
                <input type="test" data-ng-model="hours" />
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <!-- header -->
                        <h4 class="modal-title" id="myModalLabel">Edit Time</h4>
                    </div>
                    <div class="modal-body form-group">
                        <!-- TODO: Display Project ID -->
                        <!-- Change the start time -->
                        <label for="startTime">Start Time</label>
                        <input type="text" class="form-control" id=" startTime" placeholder="startTime">
                        <br />
                        <!-- Change the end time -->
                        <label for="endTime">End Time</label>
                        <input type="text" class="form-control" placeholder="endTime">
                        <!-- TODO: display total time based on start and end time -->
                        <!-- TODO: Display User ID -->
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                        <br />
                        <p>Are you sure you want to delete this time entry? You cannot undo this action.</p>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                       <button type="button" class="btn btn-primary">Yes Delete</button>
                    </div>
                </div>
            </div>
       </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include("../includes/footer.php"); ?><div class="container-fluid">