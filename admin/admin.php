<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Admin </title>
    <style>
        body {
            background-image: url('img/admin.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

            font-family: Arial, sans-serif;
        }
    </style>

</head>

<body>
    <?php include("../include/header.php"); ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left : -30px;">
                    <?php
                    include("sidenav.php");
                    include("../include/connection.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center my-3" style=" color: white;">All Admin</h5>
                                <?php
                                $ad = $_SESSION['admin'];
                                
                                $adminQuery = "SELECT id FROM admin WHERE username = '$ad'";
                                $adminResult = mysqli_query($connect, $adminQuery);
                                $adminRow = mysqli_fetch_assoc($adminResult);
                                $loggedInAdminId = $adminRow['id'];

                               
                                $query = "SELECT * FROM admin WHERE username !='$ad' ";
                                $res = mysqli_query($connect, $query);

                                $output = "
                                        <table class='table table-bordered table-success table-striped'>
                                            <tr class='table-info'>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th style='width: 10%;'>Action</th>
                                            </tr> 
                                        ";
                                if (mysqli_num_rows($res) < 1) {
                                    $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                                }

                                while ($row = mysqli_fetch_array($res)) {
                                    $id = $row[0];
                                    $username = $row['username'];

                                    $output .= "
                                                <tr>
                                                    <td>$id</td>
                                                    <td>$username</td>
                                                    <td>";

                                    
                                    if ($loggedInAdminId == 1 && $id != 1) {
                                        $output .= "<a href='?action=delete&id=$id' class='btn btn-warning'>Remove</a>";
                                    }

                                    $output .= "</td></tr>";
                                }

                                $output .= "</table>";
                                echo $output;

                               
                                if (isset($_GET['id']) && $loggedInAdminId == 1) {
                                    $id = $_GET['id'];
                                    $query = "DELETE FROM admin WHERE id='$id'";
                                    mysqli_query($connect, $query);
                                }
                                ?>

                            </div>

                            <div class="col-md-6">


                                <?php
                                if (isset($_POST['add'])) {
                                    $uname = $_POST['uname'];
                                    $pass = $_POST['pass'];
                                    $image = $_FILES['img']['name'];
                                    $error = array();

                                    if (empty($uname)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($image)) {
                                        $error['u'] = "Add Admin Picture";
                                    }

                                    if (count($error) == 0) {
                                        $q = "INSERT INTO admin(username,password,profile) VALUES('$uname','$pass','$image')";
                                        $result = mysqli_query($connect, $q);

                                        if ($result) {
                                            move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
                                        }
                                    }
                                }

                                if (isset($error['u'])) {
                                    $er = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
                                } else {
                                    $show = "";
                                }
                                ?>

                                
                                <div class="card my-3" style="background-color:#197ebd ">
                                    <div class="card-header text-center" style=" color: white;">
                                        Add New Admin
                                    </div>
                                    <div class="card-body" style=" color: white;">
                                        <?php echo $show; ?>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="uname" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="pass" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Add Admin Picture</label>
                                                <input type="file" name="img" class="form-control">
                                            </div>
                                            <br>
                                            <input type="submit" name="add" value="Add New Admin"
                                                class="btn btn-success btn-block">
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
</body>

</html>