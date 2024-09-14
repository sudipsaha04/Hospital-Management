<?php
session_start();
include("../include/header.php");
include("../include/connection.php");

$patient = $_SESSION['patient'];
$query = "SELECT * FROM patient WHERE username='$patient'";
$res = mysqli_query($connect, $query);
$row = mysqli_fetch_array($res);

include("profile_image.php");
include("user_profile.php");
include("user_credential.php");

$imageUploader = new profile_image($connect, $patient);
$profileDisplay = new user_profile($row);
$credentialUpdate = new user_credential($connect, $patient);

if (isset($_POST['upload'])) {
    $imageUploader->uploadImage($_FILES['img']);
}

if (isset($_POST['update'])) {
    $credentialUpdate->updateUsername($_POST['uname']);
}

if (isset($_POST['change'])) {
    $credentialUpdate->changePassword($_POST['old_pass'], $_POST['new_pass'], $_POST['con_pass']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Profile</title>
    <style>
        body {
            background-image: url('img/1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">

                    <head>
                        <title></title>
                        <style>
                            .sidebar {
                                height: 150vh;
                                background-image: url('img/3.jpg');
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
                                class="list-group-item list-group-item-action text-center text-white">Profile</a>
                            <a href="appointment.php"
                                class="list-group-item list-group-item-action text-center text-white">Book
                                Appointment</a>
                            <a href="receipt.php"
                                class="list-group-item list-group-item-action  text-center text-white">Invoice</a>



                        </div>


                    </body>


                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card my-3" style="background-color:#06334f;">
                                        <div class="card-header" style="color: white;">
                                            <h5 class="text-center">My Profile</h5>
                                        </div>
                                        <div class="card-body" style="color: white;">
                                            <form method="POST" enctype="multipart/form-data">
                                                <?php $profileDisplay->displayProfile(); ?>
                                                <div class="form-group">
                                                    <input type="file" name="img" class="form-control my-2">
                                                    <input type="submit" name="upload" class="btn btn-info"
                                                        value="Update Profile">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <?php $profileDisplay->displayDetails(); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card my-3" style="background-color:#06334f;">
                                        <div class="card-header" style="color: white;">
                                            <h5 class="text-center">Change Username</h5>
                                        </div>
                                        <div class="card-body" style="color: white;">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label for="username">Change Username</label>
                                                    <input type="text" id="username" name="uname" class="form-control"
                                                        autocomplete="off" placeholder="Enter Username">
                                                </div>
                                                <br>
                                                <input type="submit" name="update" class="btn btn-info"
                                                    value="Update Username">
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card my-3" style="background-color:#06334f;">
                                        <div class="card-header" style="color: white;">
                                            <h5 class="text-center">Change Password</h5>
                                        </div>
                                        <div class="card-body" style="color: white;">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" name="old_pass" class="form-control"
                                                        autocomplete="off" placeholder="Enter Old Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" name="new_pass" class="form-control"
                                                        autocomplete="off" placeholder="Enter New Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="con_pass" class="form-control"
                                                        autocomplete="off" placeholder="Enter Confirm Password">
                                                </div>
                                                <br>
                                                <input type="submit" name="change" value="Change Password"
                                                    class="btn btn-info my-2">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</body>

</html>