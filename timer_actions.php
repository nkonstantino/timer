<?php
include("includes/init.php");
//Things with AJAX/Angular:

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
@$action = $request->action;
switch(@$action){
    case "Edit":
        @$TID = $request->TID;
        @$UID = $request->UID;
        @$PID = $request->PID;
        @$SDATE = $request->SDATE;
        @$STIME = $request->STIME;
        $SDATE_trim = trim(@$SDATE,"T07:00:00.000Z");
        $STIME_trim = substr(@$STIME, 11,8);
        //echo "We got the request! TID: ".@$TID." UID: ".@$UID." PID: ".@$PID;
        echo "The date is ".$SDATE_trim." and the time is ".$STIME_trim;//need to convert time to unix.
        //create new timer
        //call timer method to edit
        //NEED TO MODIFY TIMER METHODS TO PASS DATA THROUGH!!!!!!!
        break;
    case "Add":
        echo "We're going to add a timer!";
    case "Delete":
        echo "We're going to delete a timer!";
    default:
        echo "Weird! You're not sending me an action!";
}
?>