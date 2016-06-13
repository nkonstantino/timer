<?php
include("includes/init.php");
//Things with AJAX/Angular:

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
@$action = $request->action;
switch(@$action){
    case "Edit":
        //IDs
        @$TID = $request->TID;
        @$UID = $request->UID;
        @$PID = $request->PID;
        //Start Times
        @$SDATE = $request->SDATE;
        @$STIME = $request->STIME;
        $SDATE_trim = trim(@$SDATE,"T07:00:00.000Z");
        $STIME_trim = substr(@$STIME, 11,8);
        $SDATETIME = strtotime($SDATE_trim." ".$STIME_trim);
        //End Times
        @$EDATE = $request->EDATE;
        @$ETIME = $request->ETIME;
        $EDATE_trim = trim(@$EDATE,"T07:00:00.000Z");
        $ETIME_trim = substr(@$ETIME, 11,8);
        $EDATETIME = strtotime($EDATE_trim." ".$ETIME_trim);
        //This can definitely be done better!
        $timer = new timer();
        $timer->updateTimer(@$TID,@$UID,@$PID,$SDATETIME,$EDATETIME);
     
        //echo "We got the request! TID: ".@$TID." UID: ".@$UID." PID: ".@$PID;
        echo "Start: ".$SDATETIME." End: ".$EDATETIME;//need to convert time to unix.
        //create new timer
        //call timer method to edit
        //NEED TO MODIFY TIMER METHODS TO PASS DATA THROUGH!!!!!!!
        break;
    case "Add":
        //IDs
        //No TID because timer doesn't exist yet
        @$UID = $request->UID;
        @$PID = $request->PID;
        //Start Times
        @$SDATE = $request->SDATE;
        @$STIME = $request->STIME;
        $SDATE_trim = trim(@$SDATE,"T07:00:00.000Z");
        $STIME_trim = substr(@$STIME, 11,8);
        $SDATETIME = strtotime($SDATE_trim." ".$STIME_trim);
        //End Times
        @$EDATE = $request->EDATE;
        @$ETIME = $request->ETIME;
        $EDATE_trim = trim(@$EDATE,"T07:00:00.000Z");
        $ETIME_trim = substr(@$ETIME, 11,8);
        $EDATETIME = strtotime($EDATE_trim." ".$ETIME_trim);
        //This can definitely be done better!
        $timer = new timer();
        $timer->addTimer(@$UID,@$PID,$SDATETIME,$EDATETIME);
     
        //echo "We got the request! TID: ".@$TID." UID: ".@$UID." PID: ".@$PID;
        echo "Start: ".$SDATETIME." End: ".$EDATETIME;//need to convert time to unix.
        //create new timer
        //call timer method to edit
        //NEED TO MODIFY TIMER METHODS TO PASS DATA THROUGH!!!!!!!
        break;
    case "Delete":
        //IDs
        @$TID = $request->TID;
        @$UID = $request->UID;
        $timer = new timer();
        $timer->deleteTimer(@$UID,@$TID);
        echo "We're going to delete a timer!";
        break;
    default:
        echo "Weird! You're not sending an action to timer_actions!";
}
?>