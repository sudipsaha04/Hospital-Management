<?php
session_start();
include("include/connection.php");

function validate_input($username, $password) {
    $error = array();
    if (empty($username)) {
        $error['admin'] = "Enter Username";
    } else if (empty($password)) {
        $error['admin'] = "Enter Password";
    }
    return $error;
}

function check_credentials($connect, $username, $password) {
    $query = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows == 1;
}

function login_user($username) {
    $_SESSION['admin'] = $username;
    header("Location: admin/index.php");
    exit();
}

function handle_login($connect) {
    if (isset($_POST['login'])) {
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        $error = validate_input($username, $password);
        if (count($error) == 0) {
            if (check_credentials($connect, $username, $password)) {
                echo "<script>alert('You have Login As an Admin')</script>";
                login_user($username);
            } else {
                echo "<script>alert('Invalid Username or Password')</script>";
            }
        } else {
            foreach ($error as $err) {
                echo "<script>alert('$err')</script>";
            }
        }
    }
}

handle_login($connect);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login Page</title>
</head>
<body style="background-image: url(img/hospital.jpg); background-repeat: no-repeat; background-size: cover;">
    <?php
    include("include/header.php");
    ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-white bg-dark">
                <img src="img/login.jpg" class="card-img-top" alt="Login Image">
                <div class="card-body">
                    <form method="post" class="my-2">
                        <div>
                            <?php
                            if(isset($error['admin'])) {
                                $sh = $error['admin'];
                                //$show = "<h4 class='alert alert-danger'>$sh</h4>";
                            } else {
                                $show = "";
                            }
                            echo $show;
                            ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: white;">Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: white;">Password</label>
                            <input type="password" name="pass" class="form-control">
                        </div>

                        <input type="submit" name="login" class="btn btn-success" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

