<?php
    session_start();
    require ('connection.php');
    $irrigationurl = "https://industrial.ubidots.com/api/v1.6/devices/ProjectMegumi/irrigationtime/values/?page=1&token=BBFF-zpj7XVFimwcvqL71LE1RvjlF2USqP0";
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    } else {
        $irrigationcurl = curl_init($irrigationurl);
        curl_setopt($irrigationcurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($irrigationcurl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        $jsonirrigation = curl_exec($irrigationcurl);
        curl_close($irrigationcurl);
        $irrigation = json_decode($jsonirrigation, true);

        $username =  $_SESSION["username"];
        
        $humidityq = "SELECT Humidity FROM data WHERE nodeid=1";
        $waterq = "SELECT waterlevel FROM data WHERE nodeid=1";
        $humidity = mysqli_query($con, $humidityq)
        $water = mysqli_query($con, $waterq)

        $status = "ree";

        header("refresh: 30"); 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Project Megumi</title>
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
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>HUMIDITY LEVEL</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $humidity?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-carrot fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>WATER LEVEL</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $water?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-water fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>LAST TIME OF IRRIGATION</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $irrigation?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-eye-dropper fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-pink py-2" style="color: #ff00b8;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span style="color: rgb(255,0,214);">OVERALL STATUS</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $status?></span></div>
                                    </div>
                                    <div class="col-auto">
                                        <div style="width: 40px;height: 40px;margin: 0px;background-color: #ff0000;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Graph</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                        role="menu">
                                        <p class="text-center dropdown-header">Graphs</p><a role="presentation" class="dropdown-item" href="#" onClick='document.getElementById("graph").src = "https://industrial.ubidots.com/app/dashboards/public/widget/rw1bF3NQVcOCMRD0uUyQw1QGplM?embed=true"'>Humidity Level</a><a role="presentation" class="dropdown-item" href="#" onClick='document.getElementById("graph").src = "https://industrial.ubidots.com/app/dashboards/public/widget/LO0ltHjM11qaBK1KfgRUsMmarm0?embed=true"'>Water Level</a></div>
                                </div>
                            </div><div class="card-body"><iframe id="graph" width="100%" height="450" frameborder="0" src="https://industrial.ubidots.com/app/dashboards/public/widget/rw1bF3NQVcOCMRD0uUyQw1QGplM?embed=true"></iframe></div></div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Rain Expectation</h6>
                            </div><div class="card-body"><a class="weatherwidget-io" href="https://forecast7.com/en/30d3278d03/dehradun/" data-label_1="DEHRADUN" data-label_2="WEATHER" data-mode="Forecast" data-theme="pure" >DEHRADUN WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script></div></div>
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