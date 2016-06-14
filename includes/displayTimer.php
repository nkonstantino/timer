<?php include("../includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("../includes/top_nav.php"); ?>
    <?php include("../includes/side_nav.php"); ?>
</nav>
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Admin Home </h1>
                <!-- display timer -->
                <h1>
                    <span id="hours"></span><span class="units" id="hoursUnits"></span>
                    <span id="minutes"></span><span class="units" id="minutesUnits"></span>
                    <span id="seconds">0</span><span class="units" id="secondsUnits">&nbsp;seconds, </span>
                    <span class="units">for</span>
                    <span id="currentProject">something</span>
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
                <br /><br />
                <!-- Show project id -->
                <div class="dropdown">
                    <button id="projectTimerDisplayId"class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Project ID
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" ng-repeat="timer in timers">
                        <li  onclick="setTimerDisplayProject('currentProject', this.value); setProjectId('projectTimerDisplayId', this.value)" value='{{ timer.P_id }}'><a href="#">{{ timer.P_id }}</a></li>
                    </ul>
                </div>

                <!--<?php                        
                    if(isset($_GET['submit'])){
                        $timer = new Timer();
                        $timer->start(2,2);//would get these numbers from sessions & get
                    }
                    $timer = new Timer();
                ?>-->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 submitTime">
                <!-- crate a time drop down -->
                <h4>Create a Time:</h4>

                <div class="col-lg-2">
                    <strong>Project ID</strong>
                    <div class="dropdown">
                      <button id="newProjectId"class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Project ID
                        <span class="caret"></span>
                      </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" ng-repeat="timer in timers">
                            <li onclick="setProjectId('newProjectId', this.value);" value='{{ timer.P_id }}'><a href="#">{{ timer.P_id }}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- get start time -->
                <div class="col-lg-2">
                    <label for="startTime">Start Time</label>
                    <input class="form-control" type="text" id="currentTimeStart" placeholder="Start Time" value="">
                </div>
                <div class="col-lg-3">
                    <label for="startDate">Start Date</label>
                    <input class="form-control" type="date" id="currentDayStart" value="">
                </div>
                <!-- get end time -->
                <div class="col-lg-2">
                    <label for="startTime">End Time</label>
                    <input class="form-control" type="text" id="currentTimeEnd" placeholder="End Time" value="">
                </div>
                <div class="col-lg-3">
                    <label for="startTime">End Date</label>
                    <input class="form-control" type="date" id="currentDayEnd" value="">
                </div>

                <!-- display total time -->
                <button type="button" onclick='calcTotalTime("currentTimeStart", "currentDayStart", "currentTimeEnd", "currentDayEnd", "submitTotal")' id="totalTimeSubmit" class="btn btn-info">show total</button>
                <h3 id="totalTime"><div id="submitTotal">...</div></h3>
                <div class="col-lg-3">
                    <br />
                    <button class="btn btn-warning">Save</button>

                    <!-- TODO hitting save should reset values to current time (and submit to db) -->

                </div>
                <script>setCurrentTime();</script>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10">
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
                        <td >{{ timer.S_time }}</td>
                        <td>{{ timer.E_time }}</td>
                        <td>{{ timer.T_time }}</td>
                        <td>{{ timer.U_id }}</td>
                        <td><button class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick='setModalCurrentTime()'>Edit</button></td>
                        <td><button class="btn btn-success">Resume</button></td>
                        <td><button class="btn btn-warning" data-toggle="modal" data-target="#deleteModal">Delete</button></td>
                    </tr>
                </table>
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

                            <!-- TODO: Display User ID -->

                            <!-- Display Project ID -->
                            <strong>Project ID</strong>
                            <div class="dropdown">
                              <button id="projectModalId"class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Project ID
                                <span class="caret"></span>
                              </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" ng-repeat="timer in timers">
                                    <li onclick="setProjectId('projectModalId', this.value)" value='{{ timer.P_id }}'><a href="#">{{ timer.P_id }}</a></li>
                                </ul>
                            </div>
                            <br />

                            <!-- Change the start time -->
                            <label for="startTime">Start Time</label>
                            <input class="form-control" type="text" id="modalStartTime" placeholder="Start Time" value="">
                            <br />

                            <!-- ask for start date -->
                            <label for="startDate">Start Date</label>
                            <input class="form-control" type="date" id="modalStartDate" value="">
                            <br />

                            <!-- Change the end time -->
                            <label for="startTime">End Time</label>
                            <input class="form-control" type="text" id="modalEndTime" placeholder="End Time" value="">
                            <br />

                            <!-- ask for end date -->
                            <label for="startTime">End Date</label>
                            <input class="form-control" type="date" id="modalEndDate" value="">
                            <br />

                            <!-- display total time based on start and end time -->
                            <button type="button" class="btn btn-default" onclick='calcTotalTime("modalStartTime", "modalStartDate", "modalEndTime", "modalEndDate", "totalModalTime")'>Show Total Time</button>
                            <h3><div id="totalModalTime">...</div></h3>

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TODO Resume time -->

            <!-- button should start, time should start from 0
                 and it should show the project is the same pID as resumed project -->

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
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include("../includes/footer.php"); ?><div class="container-fluid">