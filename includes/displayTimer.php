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

            <!-- display timer -->
            <h1>
                <span id="hours"></span><span id="hoursUnits"></span>
                <span id="minutes"></span><span id="minutesUnits"></span>
                <span id="seconds">0</span><span id="secondsUnits">&nbsp;sec</span>
            </h1>
            <script>// timerCounter(0,0,0); </script>

            <!-- Start timer -->
            <button class="btn btn-success" id="startTimerButton" onclick="timerCounter(0,0,0)">Start</button>
            <!-- Pause timer -->
            <button class="btn btn-warning" id="pauseTimerButton" onclick="pauseTimer()">Pause</button>
            <!-- Resume timer -->
            <button class="btn btn-success" id="resumeTimerButton" onclick="resumeTimer()">Resume</button>
            <!-- Submit timer -->
            <button class="btn btn-info" id="submitTimerButton" name="submit" onclick="submitTime()">Submit</button>

            <?php                        
                if(isset($_GET['submit'])){
                    $timer = new Timer();
                    $timer->start(2,2);//would get these numbers from sessions & get
                }
                $timer = new Timer();
            ?>
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
            <input type="text" id="currentTimeStart" placeholder="Start Time" value="">
            <input type="date" id="currentDayStart" value="">
            <!-- get end time -->
            <input type="text" id="currentTimeEnd" placeholder="End Time" value="">
            <input type="date" id="currentDayEnd" class="form-control" value="">
            <!-- TODO display total time -->
            <input type="text" placeholder="userID">
            <input type="time">
            <script>setCurrentTime();</script>

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