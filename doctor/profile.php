<?php
session_start();

error_reporting(0);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor Profile Page</title>
    <style>
        body {
            background-image: url('img/3.jpg');
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
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left : -30px;">
                <?php
                include("../include/connection.php");
                ?>

<head>
    <title></title>
    <style>
        .sidebar {
            height: 150vh;
            background-image: url('img/1713891302173.jpeg');
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
        <a href="index.php" class="list-group-item list-group-item-action  text-center text-white">Dashboard</a>
        <a href="profile.php" class="list-group-item list-group-item-action  text-center text-white">Profile</a>
        <a href="patient.php" class="list-group-item list-group-item-action text-center text-white">Patient</a>
        <a href="appointment.php" class="list-group-item list-group-item-action text-center text-white">Appointment</a>
        <a href="report.php" class="list-group-item list-group-item-action  text-center text-white">Report</a>



    </div>


</body>
            </div>

            <div class="col-md-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            $doc = $_SESSION['doctor'];
                            $query = "SELECT * FROM doctors WHERE username='$doc'";
                            $res = mysqli_query($connect, $query);
                            $row = mysqli_fetch_array($res);

                            if (isset($_POST['upload'])) {
                                $img = $_FILES['img']['name'];
                                if (!empty($img)) {
                                    $query = "UPDATE doctors SET profile='$img' WHERE username='$doc'";
                                    $res = mysqli_query($connect, $query);
                                    if ($res) {
                                        move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                                    }
                                }
                            }
                            ?>

                            <div class="card my-3" style="background-color:#197ebd ">
                                <div class="card-header" style="color: white;">
                                    <h5 class="text-center">My Profile</h5>
                                </div>
                                <div class="card-body" style="color: white;">
                                    <form method="POST" enctype="multipart/form-data">
                                        <?php
                                        echo "<img src='img/" . $row['profile'] . "' style='height:250px;' class='col-md-12 my-3'>";
                                        ?>
                                        <div class="form-group">
                                            <input type="file" name="img" class="form-control my-2">
                                            <input type="submit" name="upload" class="btn btn-info" value="Update Profile">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="my-3">
                                <table class="table table-bordered"
                                    style="width:100%; border-collapse:collapse; background-color: rgba(0, 51, 102, 0.8); color: #fff;">
                                    <tr>
                                        <th colspan="2"
                                            style="background-color: #197ebd; padding: 15px; text-align:center; border: 1px solid #fff;">
                                            Details</th>
                                    </tr>
                                    <tr style="background-color: rgba(255, 255, 255, 0.1);">
                                        <td style=" border: 1px solid #fff;">Firstname</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style=" border: 1px solid #fff;">Surname</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['surname']; ?></td>
                                    </tr>
                                    <tr style="background-color: rgba(255, 255, 255, 0.1);">
                                        <td style=" border: 1px solid #fff;">Username</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style=" border: 1px solid #fff;">Email</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr style="background-color: rgba(255, 255, 255, 0.1);">
                                        <td style=" border: 1px solid #fff;">Phone No.</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style=" border: 1px solid #fff;">Gender</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['gender']; ?></td>
                                    </tr>
                                    <tr style="background-color: rgba(255, 255, 255, 0.1);">
                                        <td style=" border: 1px solid #fff;">Country</td>
                                        <td style=" border: 1px solid #fff;"><?php echo $row['country']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style=" border: 1px solid #fff;">Salary</td>
                                        <td style=" border: 1px solid #fff;"><?php echo "TK " . $row['salary']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card my-3" style="background-color:#197ebd ">
                                <div class="card-header" style="color: white;">
                                    <h5 class="text-center">Change Username</h5>
                                </div>
                                <?php
                                if (isset($_POST['change_uname'])) {
                                    $uname = $_POST['uname'];
                                    if (!empty($uname)) {
                                        $query = "UPDATE doctors SET username='$uname' WHERE username='$doc'";
                                        $res = mysqli_query($connect, $query);
                                        if ($res) {
                                            $_SESSION['doctor'] = $uname;
                                        }
                                    }
                                }
                                ?>
                                <div class="card-body" style="color: white;">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="username">Change Username</label>
                                            <input type="text" id="username" name="uname" class="form-control"
                                                autocomplete="off" placeholder="Enter Username">
                                        </div>
                                        <br>
                                        <input type="submit" name="change_uname" class="btn btn-info"
                                            value="Update Username">
                                    </form>
                                </div>
                            </div>

                            <div class="card my-3" style="background-color:#197ebd ">
                                <div class="card-header" style="color: white;">
                                    <h5 class="text-center">Change Password</h5>
                                </div>
                                <?php
                                if (isset($_POST['change_pass'])) {
                                    $old = $_POST['old_pass'];
                                    $new = $_POST['new_pass'];
                                    $con = $_POST['con_pass'];
                                    $ol = "SELECT * FROM doctors WHERE username = '$doc'";
                                    $ols = mysqli_query($connect, $ol);
                                    $row = mysqli_fetch_array($ols);

                                    if ($old == $row['password'] && !empty($new) && $new == $con) {
                                        $query = "UPDATE doctors SET password='$new' WHERE username='$doc'";
                                        mysqli_query($connect, $query);
                                    }
                                }
                                ?>
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
                                                autocomplete="off" placeholder="Confirm Password">
                                        </div>
                                        <br>
                                        <input type="submit" name="change_pass" value="Change Password"
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
</body>

</html>
