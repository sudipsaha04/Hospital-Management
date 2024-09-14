<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Patient Details</title>
    <style>
        body {
            background-image: url('img/patient.jpg');
           
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left : -30px;">

                    <head>
                        <title></title>
                        <style>
                            
                            .sidebar {
                                height: 120vh;
                                background-image: url('img/1.jpg');
                              
                                background-size: cover;
                               
                                background-repeat: no-repeat;
                                background-position: center;
                                overflow: hidden;
                               
                            }

                            .list-group-item {
                                background-color: transparent;
                               
                            }

                            .list-group-item:hover {
                                background-color: rgba(255, 255, 255, 0.2);
                                
                                color: #f0f0f0;
                               
                            }
                        </style>
                    </head>

                    <body>
                     
                        <div class="list-group  sidebar">
                            <a href="index.php"
                                class="list-group-item list-group-item-action  text-center text-white">Dashboard</a>
                            <a href="profile.php"
                                class="list-group-item list-group-item-action  text-center text-white">Profile</a>
                            <a href="admin.php"
                                class="list-group-item list-group-item-action  text-center text-white">Administrators</a>
                            <a href="doctor.php"
                                class="list-group-item list-group-item-action  text-center text-white">Doctors</a>
                            <a href="patient.php"
                                class="list-group-item list-group-item-action  text-center text-white">Patient</a>
                            <a href="report.php"
                                class="list-group-item list-group-item-action  text-center text-white">Report</a>
                            <a href="job_request.php"
                                class="list-group-item list-group-item-action  text-center text-white">Job-Request</a>
                            <a href="income.php"
                                class="list-group-item list-group-item-action  text-center text-white">Income</a>
                        </div>
                        
                    </body>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2" style=" color: white;">View Patient Details</h5>

                    <?php

                    if (isset($_GET['id'])) {

                        $id = $_GET['id'];

                        $query = "SELECT * FROM patient WHERE id = '$id'";
                        $res = mysqli_query($connect, $query);

                        $row = mysqli_fetch_array($res);
                    }

                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <?php
                                echo "<img src='../patient/img/" . $row['profile'] . "' class='col-md-12 my-2' height='250px;'>";
                                ?>
                                <table class="table table-bordered table-hover table-info table-striped">
                                    <tr class="table table-primary">
                                        <th colspan="2" class="text-center">Details</th>
                                    </tr>
                                    <tr>
                                        <td>Firstname</td>
                                        <td><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Surname</td>
                                        <td><?php echo $row['surname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $row['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone No.</td>
                                        <td><?php echo $row['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $row['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo $row['country']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Registered</td>
                                        <td><?php echo $row['date_reg']; ?></td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                    </div>




</body>

</html>