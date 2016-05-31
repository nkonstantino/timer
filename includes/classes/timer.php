<?php 
//Timer Class. Lets do this!

class Timer{
    //Variables
    public $start;
    public $end;
    public $total;
    
    function __construct(){
        //maybe set start here if we have the button starting the timer also creating it?
    }
    
    public function start($u,$p){
        //PURPOSE: START THE TIMER + SEND INFO TO THE DATABASE
        include('database.php');//make sure it knows where the database is.
        //get current time
        $check = $this->check_exist($u,$p);
        if(!$check){  //Check to see if the user has a timer already running
            $start=time();  //Set the start Time
            //add timer to db w/PDO
            $sql = "INSERT INTO timer(P_id,S_time,U_id) VALUE({$p},{$start},{$u}) ";
            //need to get P_id and U_id from session
            $s_time = $db->query($sql);
            if($s_time){
                echo "Timer Started at: ".$start;
                //success message
            } else {
                echo "Timer Start Fail";
            }
        } else {
            echo "Timer already running!";
        }
    }//END START FUNCTION
    
    public function stop($u,$p){
        //PURPOSE: STOP THE TIMER + SEND INTO TO THE DATABASE
        include('database.php');//make sure it knows where the database is.
        //get current time
        $stop=time();
        //UPDATE E_time in db
        $sql = "UPDATE timer SET E_time = {$stop} WHERE U_id = {$u} AND P_id = {$p} AND E_time = 0 ";
        $s_time = $db->query($sql);
        if($s_time){
            echo "Timer Stopped at: ".$stop;
            //success message
        }else{
            echo "Timer Stop Fail";
        }
        
    }//END STOP FUNCTION
    
    public function check_exist($u,$p){
        //PURPOSE: Check to see if a timer has already been started for a user/project combo
        //RETURNS 0 if no timers exist, else RETURNS 1 or more 
        include('database.php');//make sure it knows where the database is.
        //check to see if a timer has both a start and end time.
        $sql = "SELECT COUNT(*) FROM timer WHERE U_id = {$u} AND P_id = {$p} AND E_time = 0 "; 
        //Checks for User + Project ID combo with no end time.
        $timer_check = $db->prepare($sql);
        $timer_check->execute();
        $result = $timer_check->fetchColumn();
        //Counts the number of results that match.
        echo "Found Started Timers: ".$result."<br>";
        return $result; //FUCK YES FINALLY WORKS
        
    }
                        
    
    public function displayAll(){
        include('database.php');//make sure it knows where the database is.
        //find all of the timers
        $sql = 'SELECT * FROM timer WHERE U_id = 2';
        echo "<br>";
        foreach($db->query($sql) as $row){
            $P_id = $row['P_id'];
            $S_time = $row['S_time'];
            $E_time = $row['E_time'];
            $T_time = $this->total($S_time,$E_time);
            echo "Project: ".$P_id." Start Time: ".$S_time." End Time: ".$E_time.$T_time."<br>";
        }//That was easy.
    }
    
    public function changeTimer(){
        //PURPOSE: This is for editing timers.  Not sure how I want to handle it yet.
        //I think I want a modal to pop up when selecting "edit" and then letting user submit changes.
    }
    
    private function total($start,$end){
        //get start and stop times from function call
        //find difference
        $total = $end - $start;
        //echo "<br>";
        //echo $total." seconds";
        if( $total > 0){
            return " Total Time: ".floor($total/60) . " minutes";
        } else {
            return NULL;
        }
        //return $total/3600 . " hours";
    }
}
?>