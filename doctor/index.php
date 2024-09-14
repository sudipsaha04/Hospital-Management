<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor's Dashboard</title>
    <style>
        body {
            background-image: url('img/3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

            font-family: Arial, sans-serif;
        }


        .container-fluid {
            background: rgba(0, 0, 0, 0.6);
        }

        .list-group-item {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .dashboard-box {
            height: 130px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .dashboard-box h5 {
            margin: 0;
        }

        .dashboard-box a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h4 class="my-2 text-white">Doctor Dashboard</h4>

                <div class="row">
                    <div class="col-md-3 my-3 bg-success mx-3 dashboard-box">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="text-white my-4">My Profile</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="profile.php"><i class="fa fa-user-circle fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 my-2 bg-warning mx-2 dashboard-box" style="height: 150px;">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                $p = mysqli_query($connect, "SELECT * FROM patient");
                                $pp = mysqli_num_rows($p);
                                ?>
                                <h5 class="text-white my-2" style="font-size:30px;"><?php echo $pp; ?></h5>
                                <h5 class="text-white">Total</h5>
                                <h5 class="text-white">Patient</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="patient.php"><i class="fa fa-procedures fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 my-2 bg-success mx-2 dashboard-box" style="height: 150px;">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                $app = mysqli_query($connect, "SELECT * FROM appointment WHERE status='pending'");
                                $appoint = mysqli_num_rows($app);
                                ?>
                                <h5 class="text-white my-2" style="font-size:30px;"><?php echo $appoint; ?></h5>
                                <h5 class="text-white">Total</h5>
                                <h5 class="text-white">Appointment</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="appointment.php"><i class="fa fa-calendar fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>