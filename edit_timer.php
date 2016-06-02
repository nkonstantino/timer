<?php include("includes/header.php"); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>
<?php 
//Send edited information to the server!
//POST data to variables
//convert back to unix time.
//get E_time
//SQL UPDATE query
if(isset($_POST['update_timer'])){
    $t_id = $_POST['t_id'];
    $u_id = $_POST['u_id'];
    $p_id = $_POST['u_id'];
    $s_time = $_POST['s_time'];
    $s_date = $_POST['s_date'];
    $e_time = $_POST['e_time'];
    $e_date = $_POST['e_date'];
    
    //time conversion
    $s_time_conv = date('U',strtotime($s_date." ".$s_time)); //I DID IT!!
    echo $s_time_conv;
}
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Home
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit Timer
                            </li>
                        </ol>
                    </div>
                    <?php 
                    //Fill in form information!
                    //GET T_id
                    //SQL T_id, output U_id, P_id, S_time, E_time
                    //convert S_time and E_time to date and time.
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
                    
                    
                    
                    ?>
                    <div class="col-lg-12">                     
                            <form action="" method="post" enctype="multipart/form-data">
                                   <!--T_id, U_id, P_id, S_time, E_time-->
                                    <label for="t_id">Timer ID</label>
                                    <input type="text" name="t_id" value="<?php echo $T_id ?>"><br>
                                    <label for="u_id">User ID</label>
                                    <input type="text" name="u_id" value="<?php echo $U_id ?>"><br>
                                    <label for="p_id">Project ID</label>
                                    <input type="text" name="p_id" value="<?php echo $P_id ?>"><br>
                                    <label for="s_date">Start Date/Time</label>
                                    <input type="date" name="s_date" value="<?php echo $s_date; ?>">
                                    <input type="time" name="s_time" value="<?php echo $s_time; ?>"><br>
                                    <label for="e_date">End Date/Time</label>
                                    <input type="date" name="e_date" value="<?php echo $e_date; ?>">
                                    <input type="time" name="e_time" value="<?php echo $e_time; ?>"><br>
                                    <input type="submit" value="Update" name="update_timer">
                            </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>