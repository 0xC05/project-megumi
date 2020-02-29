<?php
    session_start();
    require ('connection.php');
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    } else if (isset($_POST['submit'])) {
        if($_POST['nodeid'] == "1"){
            $postnodeid = 1;
        }
        if($_POST['nodeid'] == "2"){
            $postnodeid = 2;
        }
        if($_POST['cropsetting'] == "paddy"){
            $postcrop = "paddy";
        }
        if($_POST['cropsetting'] == "nonpaddy"){
            $postcrop = "nonpaddy";
        }
        $updatequery = "UPDATE threshold SET type='$postcrop' WHERE nodeId=$postnodeid";
        $updateexec = mysqli_query($con, $updatequery);
        header("Refresh:0");
    } else {
        $username =  $_SESSION["username"];
        
        $query1 = "SELECT * FROM threshold WHERE nodeId=1";
        $query2 = "SELECT * FROM threshold WHERE nodeId=2";
        $query1output = mysqli_query($con, $query1);
        $query2output = mysqli_query($con, $query2);
        $query1parsed = mysqli_fetch_assoc($query1output);
        $query2parsed = mysqli_fetch_assoc($query2output);
        $node1crop = $query1parsed["type"];
        $node2crop = $query2parsed["type"];

    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Project Megumi</title>
    <meta name="description" content="A Smart Irrigation System for Farmers">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="font-size: 18px;">
                    <div class="container-fluid">
                        <p style="padding: 0px;padding-top: 18px;color: rgb(123,136,237);font-size: 22px;padding-right: 0px;padding-left: 8px;"><strong>Project Megumi</strong></p>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1" role="presentation"></li>
                            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $username?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/user.jpg"></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="index.php"><i class="fas fa-chart-bar fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Dashboard</a><a class="dropdown-item" role="presentation" href="settings.php"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a
                                            class="dropdown-item" role="presentation" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Settings</h3>
                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-3" style="width: 100%;">
                            <div class="card-header py-3" style="width: 100%;">
                                <p class="text-primary m-0 font-weight-bold">User Settings</p>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" placeholder="<?php echo $username?>" name="username" disabled=""></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Crop Settings</p>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-row">
                                        <div class="col">
                                            <p><strong>Current Node Settings:-</strong></p>
                                            <p><strong>Node 1 - <?php echo $node1crop?></strong><br><strong>Node 2 - <?php echo $node2crop?></strong></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="node"><strong>Node ID</strong><br></label><select class="form-control" name="nodeid"><option value="1" selected="">1</option><option value="2">2</option></select></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label for="crop"><strong>Crop Type</strong></label><select class="form-control" name="cropsetting"><option value="paddy" selected="">Paddy</option><option value="nonpaddy">Non-Paddy</option></select></div>
                                        </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="submit">Save&nbsp;Settings</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Project Megumi 2019</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>