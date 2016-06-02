<?php include("includes/header.php"); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>
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
                                <i class="fa fa-file"></i> Add Timer
                            </li>
                        </ol>
                    </div>
                    <?php 
                        if(isset($_POST['add_timer'])){
                            $timer = new Timer();
                            $timer->addTimer();
                        }
                    ?>
                    <div class="col-lg-12">                     
                            <form action="" method="post" enctype="multipart/form-data">
                                   <!--T_id, U_id, P_id, S_time, E_time-->
                                    <label for="u_id">User ID</label>
                                    <input type="text" name="u_id" placeholder="User ID"><br>
                                    <label for="p_id">Project ID</label>
                                    <input type="text" name="p_id" placeholder="Project ID"><br>
                                    <label for="s_date">Start Date/Time</label>
                                    <input type="date" name="s_date" value="<?php echo date("Y-m-d",time()); ?>">
                                    <input type="time" name="s_time" value="<?php echo "12:00:00"; ?>"><br>
                                    <label for="e_date">End Date/Time</label>
                                    <input type="date" name="e_date" value="<?php echo date("Y-m-d",time()); ?>">
                                    <input type="time" name="e_time" value="<?php echo "00:00:00"; ?>"><br>
                                    <input type="submit" value="Update" name="add_timer">
                            </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>