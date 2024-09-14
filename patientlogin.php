<?php

session_start();

include("include/connection.php");

if (isset($_POST['login'])) {

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];



    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } else if (empty($pass)) {
        $error['login'] = "Enter Password";
    } else {
        $query = "SELECT * FROM patient WHERE username='$uname' AND password = '$pass'";

        $res = mysqli_query($connect, $query);

        if (mysqli_num_rows($res)) {

            header("Location:patient/index.php");

            $_SESSION['patient'] = $uname;
        } else {
            echo "<script>alert('Invalid Account')</script>";
        }
    }
}





?>


<!DOCTYPE html>
<html>

<head>
    <title>Patient Login Page</title>
    <style>
        body {
            background-image: url('img/3.jpg');
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

        .login-card input {
            border-radius: 0.375rem;
            border: 1px solid #198754;
            background-color: #f1f1f1;
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
                <img src="img/admin.png" class="img-fluid" alt="Admin Image">
                <h4 class="text-center mb-4">Patient Login</h4>

                <form method="post">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off"
                            placeholder="Enter Username">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" autocomplete="off"
                            placeholder="Enter Password">
                    </div>


                    <button type="submit" name="login" class="btn" value="Login">Login</button>

                    <p>I don't have an account <a href="account.php">Click here.</a></p>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>