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
//        echo "<br>";
        foreach($db->query($sql) as $row){
            $P_id = $row['P_id'];
            $S_time = $row['S_time'];
            $E_time = $row['E_time'];
            $T_time = $this->total($S_time,$E_time);
//            echo "Project: ".$P_id." Start Time: ".$S_time." End Time: ".$E_time.$T_time."<br>";
        }//test display of information
        //Below is for the actual JSON file
        $thing = $db->prepare($sql);
        $thing->execute();
        $display = $thing->fetchAll();
        echo json_encode($display);
        
        //try-catch block?
    }
    
    public function updateTimer(){
        include('database.php');
        //PURPOSE: This is for editing exisiting timers.
        //Will create "editTimer.php" for form.
        //Query by timer ID
        if(isset($_POST['update_timer'])){
            $t_id = $_POST['t_id'];
            $u_id = $_POST['u_id'];
            $p_id = $_POST['p_id'];
            $s_time = $_POST['s_time'];
            $s_date = $_POST['s_date'];
            $e_time = $_POST['e_time'];
            $e_date = $_POST['e_date'];

            //time conversion
            $s_time_conv = date('U',strtotime($s_date." ".$s_time)); //I DID IT!!
            $e_time_conv = date('U',strtotime($e_date." ".$e_time));
            $t_time = $this->total($s_time_conv,$e_time_conv);
            $sql = "UPDATE timer SET P_id={$p_id},U_id={$u_id},S_time={$s_time_conv},E_time={$e_time_conv},T_time={$t_time} WHERE T_id={$t_id}";
            $db->query($sql);
        } else {
            echo "This is for use with the update_timer form!";
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
    
    public function addTimer(){
        //PURPOSE: Add a timer that a user might have forgotten to record.
        //Will create "addTimer.php" for form.
        //Insert query ezpz.
        include('database.php');
        if(isset($_POST['add_timer'])){
            $u_id = $_POST['u_id'];
            $p_id = $_POST['p_id'];
            $s_time = $_POST['s_time'];
            $s_date = $_POST['s_date'];
            $e_time = $_POST['e_time'];
            $e_date = $_POST['e_date'];

            //time conversion
            $s_time_conv = date('U',strtotime($s_date." ".$s_time)); //I DID IT!!
            $e_time_conv = date('U',strtotime($e_date." ".$e_time));
            $t_time = $this->total($s_time_conv,$e_time_conv);
            $sql = "INSERT INTO timer (P_id,U_id,S_time,E_time,T_time) VALUES ({$p_id},{$u_id},{$s_time_conv},{$e_time_conv},{$t_time})";
            $db->query($sql);
            echo "Timer Added!";
        } else {
            echo "This is for use with the update_timer form!";
        }
    }
    
    private function total($start,$end){
        //get start and stop times from function call & find difference
        $total = $end - $start;
        return $total;
    }
}
?>