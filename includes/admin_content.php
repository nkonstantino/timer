<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Home
                            <small>Subheading</small>
                        </h1>
                       <?php
                            
//                        $sql = "SELECT * FROM users WHERE user_id = 1";
//                        $result = $database->query($sql);
//                        $user_found = mysqli_fetch_array($result);
//                        
//                        echo "The user is ".$user_found['username'];
                        ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-12">
                    <?php                        
                        if(isset($_GET['action'])){
                            switch ($_GET['action']){
                                case "Start":
                                    $timer = new Timer();
                                    $timer->start(2,2);//would get these numbers from sessions & get
                                    break;
                                case "Stop":
                                    $timer = new Timer();
                                    $timer->stop(2,2); //would get these numbers from sessions
                                    break;
                                default:
                                    $timer = new Timer();
                                    $timer->displayAll();
                            }
                        }
                        $timer = new Timer();
                        //$timer->start(2,2);
                        //$timer->check_exist(2,2);
                        $timer->displayAll();
                    ?>
                    <form action="" method="get">
                        <input type="submit" value="Start" name="action">
                        <input type="submit" value="Stop" name="action">
                    </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->