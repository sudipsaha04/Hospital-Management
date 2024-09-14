<?php
session_start();
include("include/connection.php");

function validate_input($username, $password)
{
    $error = array();
    if (empty($username)) {
        $error['admin'] = "Enter Username";
    } else if (empty($password)) {
        $error['admin'] = "Enter Password";
    }
    return $error;
}

function check_credentials($connect, $username, $password)
{
    $query = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows == 1;
}

function login_user($username)
{
    $_SESSION['admin'] = $username;
    header("Location: admin/index.php");
    exit();
}

function handle_login($connect)
{
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

    <style>
        body {
            background-image: url('img/rsz_1.jpg');
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
    <?php include("include/header.php"); ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="login-card shadow text-white">
                <img src="img/admin.png" class="img-fluid" alt="Admin Image">
                <h4 class="text-center mb-4">Admin Login</h4>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off"
                            placeholder="Enter Username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                    </div>
                    <button type="submit" name="login" class="btn">Login</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>