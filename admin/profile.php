<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Profile</title>
    <style>
        body {
            background-image: url('img/t.png');
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

    $ad = $_SESSION['admin'];
    $query = "SELECT * FROM admin Where username='$ad'";
    $res = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($res)) {
        $username = $row['username'];
        $profiles = $row['profile'];
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">

                <head>
                    <title></title>
                    <style>
                        .sidebar {
                            height: 110vh;
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
                    <div class="list-group sidebar">
                        <a href="index.php" class="list-group-item list-group-item-action text-center text-white">Dashboard</a>
                        <a href="profile.php" class="list-group-item list-group-item-action text-center text-white">Profile</a>
                        <a href="admin.php" class="list-group-item list-group-item-action text-center text-white">Administrators</a>
                        <a href="doctor.php" class="list-group-item list-group-item-action text-center text-white">Doctors</a>
                        <a href="patient.php" class="list-group-item list-group-item-action text-center text-white">Patient</a>
                        <a href="report.php" class="list-group-item list-group-item-action text-center text-white">Report</a>
                        <a href="job_request.php" class="list-group-item list-group-item-action text-center text-white">Job-Request</a>
                        <a href="income.php" class="list-group-item list-group-item-action text-center text-white">Income</a>
                    </div>
                </body>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card my-3" style="background-color:#197ebd ">
                            <div class="card-header" style=" color: white;">
                                <h5 class="text-center"><?php echo $username; ?>'s Profile</h5>
                            </div>
                            <div class="card-body" style=" color: white;">
                                <?php
                                if (isset($_POST['update'])) {
                                    $profile = $_FILES['profile']['name'];

                                    if (!empty($profile)) {
                                        $query = "UPDATE admin SET profile='$profile' WHERE username='$ad'";
                                        $result = mysqli_query($connect, $query);

                                        if ($result) {
                                            move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
                                        }
                                    }
                                }
                                ?>

                                <form method="post" enctype="multipart/form-data">
                                    <?php echo "<img src='img/$profiles' class='img-fluid mb-3' style='height: 250px;'>"; ?>
                                    <div class="form-group">
                                        <label>UPDATE PROFILE</label>
                                        <input type="file" name="profile" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update" value="UPDATE" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card my-3" style="background-color:#197ebd ">
                            <div class="card-header" style=" color: white;">
                                <h5 class="text-center">Change Username</h5>
                            </div>
                            <div class="card-body" style=" color: white;">
                                <?php
                                if (isset($_POST['change'])) {
                                    $uname = $_POST['uname'];
                                    if (!empty($uname)) {
                                        $query = "UPDATE admin SET username='$uname' WHERE username='$ad'";
                                        $res = mysqli_query($connect, $query);
                                        if ($res) {
                                            $_SESSION['admin'] = $uname;
                                        }
                                    }
                                }
                                ?>

                                <form method="post">
                                    <div class="form-group">
                                        <label>New Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off"
                                            placeholder="Enter username">
                                    </div>
                                    <br>
                                    <input type="submit" name="change" class="btn btn-success" value="Change">
                                </form>
                            </div>
                        </div>
                        
                        <div class="card my-3" style="background-color:#197ebd ">
                            <div class="card-header" style=" color: white;">
                                <h5 class="text-center">Change Password</h5>
                            </div>
                            <div class="card-body" style=" color: white;">
                                <?php
                                if (isset($_POST['update_pass'])) {
                                    $old_pass = $_POST['old_pass'];
                                    $new_pass = $_POST['new_pass'];
                                    $con_pass = $_POST['con_pass'];
                                    $error = array();

                                    $old = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$ad'");
                                    $row = mysqli_fetch_array($old);
                                    $pass = $row['password'];

                                    if (empty($old_pass)) {
                                        $error['p'] = "Enter old password";
                                    } else if (empty($new_pass)) {
                                        $error['p'] = "Enter new password";
                                    } else if (empty($con_pass)) {
                                        $error['p'] = "Confirm password";
                                    } else if ($old_pass != $pass) {
                                        $error['p'] = "Invalid old password";
                                    } else if ($new_pass != $con_pass) {
                                        $error['p'] = "Passwords do not match";
                                    }

                                    if (count($error) == 0) {
                                        $query = "UPDATE admin SET password='$new_pass' WHERE username='$ad'";
                                        mysqli_query($connect, $query);
                                    }
                                }

                                if (isset($error['p'])) {
                                    $e = $error['p'];
                                    $show = "<div class='alert alert-danger'>$e</div>";
                                } else {
                                    $show = "";
                                }
                                ?>

                                <form method="post">
                                    <?php echo $show; ?>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_pass" class="form-control"
                                            placeholder="old password">
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_pass" class="form-control"
                                            placeholder="new password">
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="con_pass" class="form-control"
                                            placeholder="confirm password">
                                    </div>
                                    <br>
                                    <input type="submit" name="update_pass" value="Update Password"
                                        class="btn btn-info">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
