<?php

session_start();

include("include/connection.php");

if (isset($_POST['login'])) {

    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        $q = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $qq = mysqli_query($connect, $q);

        if (mysqli_num_rows($qq) > 0) {
            $row = mysqli_fetch_array($qq);

            if ($row['status'] == "Pending") {
                $error['login'] = "Please Wait for the admin to confirm";
            } else if ($row['status'] == "Rejected") {
                $error['login'] = "Try again Later";
            } else {
                
                $_SESSION['doctor'] = $uname;
                header("Location: doctor/index.php");
                exit(); 
            }
        } else {
            $error['login'] = "Invalid Username or Password";
        }
    }
}

if (isset($error['login'])) {
    $l = $error['login'];
    $show = "<h5 class='text-center alert alert-danger'>$l</h5>";
} else {
    $show = "";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor Login Page</title>
    <style>
        body {
            background-image: url('img/rsz_14.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-card {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 2rem;
            border-radius: 12px;
        }

        .login-card img {
            max-width: 80px;
            margin: 0 auto 1rem;
            display: block;
        }

        .login-card button {
            border-radius: 0.375rem;
            width: 100%;
            max-width: 100px;
            padding: 0.75rem;
            background-color: #3299a8;
            color: white;
            transition: background-color 0.3s ease;
            margin: 0 auto;
        }

        .login-card button:hover {
            background-color: #3273a8;
        }

        .form-label {
            color: #ffffff;
        }
    </style>
</head>

<body>

    <?php
    include("include/header.php");
    ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="login-card shadow text-white">
                <img src="img/admin.png" class="img-fluid" alt="Doctor Image">
                <h4 class="text-center mb-4">Doctor Login</h4>

                <div>
                    <?php echo $show; ?>
                </div>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off"
                            placeholder="Enter Username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control" autocomplete="off"
                            placeholder="Enter Password">
                    </div>

                    <button type="submit" name="login" class="btn" value="Login">Login</button>

                    <p>I don't have an account <a href="apply.php">Apply Now!!!</a></p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>