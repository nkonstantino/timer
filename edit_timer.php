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
                    }
                    
                    
                    
                    ?>
                    <div class="col-lg-12">                     
                            <form action="" method="post">
                                   <!--T_id, U_id, P_id, S_time, E_time-->
                                    <label for="u_id">User ID</label>
                                    <input type="text" id="u_id"><br>
                                    <label for="p_id">Project ID</label>
                                    <input type="text" id="p_id"><br>
                                    <label for="s_date">Start Date/Time</label>
                                    <input type="date" id="s_date">
                                    <input type="time" id="s_time"><br>
                                    <label for="e_date">End Date/Time</label>
                                    <input type="date" id="e_date">
                                    <input type="time" id="e_time"><br>
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