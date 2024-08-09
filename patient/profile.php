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
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>My Profile</h5>
                                    <form method="POST" enctype="multipart/form-data">
                                        <?php $profileDisplay->displayProfile(); ?>
                                        <input type="file" name="img" class="form-control my-2">
                                        <input type="submit" name="upload" class="btn btn-info" value="Update Profile">
                                    </form>
                                    <div class="my-3">
                                        <?php $profileDisplay->displayDetails(); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-center">Change Username</h5>
                                    <form method="post">
                                        <label>Change Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                        <br>
                                        <input type="submit" name="update" class="btn btn-info my-2" value="Update Username">
                                    </form>
                                    <br><br>

                                    <h5 class="text-center my-2">Change Password</h5>
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
                                        </div>
                                        <br>
                                        <input type="submit" name="change" value="Change Password" class="btn btn-info my-2">
                                    </form>
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
