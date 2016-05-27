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
    
    public function start(){
        include('database.php');//make sure it knows where the database is.
        //get current time
        $start=time();
        //add timer to db w/PDO
        $sql = "INSERT INTO timer(P_id,S_time,U_id) VALUE(2,{$start},2) ";
        //need to get P_id and U_id from session?
        $s_time = $db->query($sql);
        if($s_time){
            echo "Timer Started at: ";
        }
        //success message
        echo $start;
    }
    
    public function stop(){
        include('database.php');//make sure it knows where the database is.
        //get current time
        $stop=time();
        //send time to db
         $sql = "INSERT INTO timer(T_id,P_id,S_time,U_id) VALUE(2,2,{$stop},2) ";
        $s_time = $db->query($sql);
        if($s_time){
            echo "Timer Stopped at: ";
        }
        //success message
        echo $stop;
    }
    
    public function check($timer_id){
        include('database.php');//make sure it knows where the database is.
        //check to see if a timer has both a start and end time.
        $sql = "SELECT * FROM timer WHERE T_id = {$timer_id}"; 
        //Should it check Timer ID? User ID? Project ID? Session?
        $timer_check = $db->prepare($sql);
        $result = $db->query($sql);
        print_r($result);//Not sure what to do with this.
        //Maybe use fetchColumn()?
        //Maybe $timer_check=$db=exec($sql) if > 0 then [...]??
        echo "<br>";
        
    }
                        
    
    public function displayAll(){
        include('database.php');//make sure it knows where the database is.
        //find all of the timers
        $sql = 'SELECT * FROM timer';
        foreach($db->query($sql) as $row){
            echo "Project: ".$row['P_id']." Start Time: ".$row['S_time']." End Time: ".$row['E_time']."<br>";
        }//That was easy.
    }
    
    private function total(){
        //get start and stop times from db
        //find difference
        //send time to db
        //success message
        
        //Run timer->check() first, then
        //use DateTime Object->diff()?
    }
}
?>