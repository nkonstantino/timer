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
        $check = $this->check_exist($u,$p);
        if($check){
            $stop=time();//get current time
            //Calculate T_Time
            $t_sql = "SELECT * FROM timer WHERE U_id = {$u} AND P_id = {$p} AND E_time = 0 ";
            foreach($db->query($t_sql) as $row){
                $S_time = $row['S_time'];
                $T_time = $this->total($S_time,$stop);
            }
            //UPDATE E_time in db
            $sql = "UPDATE timer SET E_time = {$stop}, T_time = {$T_time} WHERE U_id = {$u} AND P_id = {$p} AND E_time = 0 ";
            $s_time = $db->query($sql);
            if($s_time){
                echo "Timer Stopped at: ".$stop;
                //success message
            }else{
                echo "Timer Stop Fail";
            }
        } else {
            echo "No timer to stop!";
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
        //echo "Found Started Timers: ".$result."<br>";
        return $result; //FUCK YES FINALLY WORKS
        
    }
                        
    
    public function displayAll(){
        //PURPOSE: Send out information to display all timers.
        //needs to return JSON encode query for Angular.
        include('database.php');//make sure it knows where the database is.
        //find all of the timers
        $sql = 'SELECT * FROM timer';
        //Below is for the actual JSON file
        $thing = $db->prepare($sql);
        $thing->execute();
        $display = $thing->fetchAll(PDO::FETCH_ASSOC); //get rid of the ugly indexes
        echo json_encode($display, JSON_NUMERIC_CHECK); //Make JSON, make numbers into numbers!
    }
    
    public function updateTimer($t_id,$u_id,$p_id,$s_datetime,$e_datetime){
        include('database.php');
        //PURPOSE: This is for editing exisiting timers.
        //UPDATED TO WORK WITH ANGULAR FORM!
        $t_time = $this->total($s_datetime,$e_datetime);
        $sql = "UPDATE timer SET P_id={$p_id},U_id={$u_id},S_time={$s_datetime},E_time={$e_datetime},T_time={$t_time} WHERE T_id={$t_id}";
        $update = $db->query($sql);
        if($update){
            return true;
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 internal server error', true, 500);
        }
    }
    
    public function getTimer(){ //This doesn't work?
        include('database.php');
        if(isset($_GET['t_id'])){
            $t_id = $_GET['t_id'];
            $sql = "SELECT * FROM timer WHERE T_id = {$t_id}";
            foreach($db->query($sql) as $row){
                $T_id = $row['T_id'];
                $P_id = $row['P_id'];
                $U_id = $row['U_id'];
                $S_time = $row['S_time'];
                $E_time = $row['E_time'];
            }
            //convert times
            $s_date = date('Y-m-d',$S_time);
            $s_time = date('h:i:s',$S_time);
            $e_date = date('Y-m-d',$E_time);
            $e_time = date('h:i:s',$E_time);
        }
    }
    
    public function addTimer($u_id,$p_id,$s_datetime,$e_datetime){
        //PURPOSE: Add a timer that a user might have forgotten to record.
        include('database.php');
        $t_time = $this->total($s_datetime,$e_datetime);
        $sql = "INSERT INTO timer (P_id,U_id,S_time,E_time,T_time) VALUES ({$p_id},{$u_id},{$s_datetime},{$e_datetime},{$t_time})";
        $add = $db->query($sql);
        if($add){
            return true;
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 internal server error', true, 500);
        }
    }
    
    public function deleteTimer($U_id,$T_id){
        //PURPOSE: Delete selected timer!
        include('database.php');
        $sql = "DELETE FROM timer WHERE T_id = {$T_id} AND U_id = {$U_id}";
        $del = $db->query($sql);
        if($del){
            return true;
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 internal server error', true, 500);
        }
    }

    private function total($start,$end){
        //get start and stop times from function call & find difference
        $total = $end - $start;
        return $total;
    }
}
?>