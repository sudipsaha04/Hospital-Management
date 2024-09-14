<?php

include("include/connection.php");
$show = "";

if (isset($_POST['apply'])) {

    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];

    $error = array();

    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    } else if (empty($surname)) {
        $error['apply'] = "Enter Surname";
    } else if (empty($username)) {
        $error['apply'] = "Enter Username";
    } else if (empty($email)) {
        $error['apply'] = "Enter Email Address";
    } else if (empty($gender)) {
        $error['apply'] = "Select Your Gender";
    } else if (empty($phone)) {
        $error['apply'] = "Enter Phone Number";
    } else if (empty($country)) {
        $error['apply'] = "Select Country";
    } else if (empty($password)) {
        $error['apply'] = "Enter Password";
    } else if ($confirm_password != $password) {
        $error['apply'] = "Both Password do not match";
    }

    if (count($error) == 0) {

        $query = "INSERT INTO doctors(firstname,surname,username,email,gender,phone,country,password,salary,data_reg,status,profile) VALUES
        ('$firstname','$surname','$username','$email','$gender','$phone','$country', '$password','0',NOW(),'Pending','doctor.jpg')";

        $result = mysqli_query($connect, $query);

        if ($result) {

            echo "<script>alert('You have Successfully Applied')</script>";

            header("Location: doctorlogin.php");
        } else {

            echo "<script>alert('Failed')</script>";

        }
    }

}

if (isset($error['apply'])) {
    $s = $error['apply'];


} else {
    $show = "";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Apply Now!!!</title>

    <style>
        body {
            background-image: url('img/rsz_14.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

            overflow: auto;



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
            max-width: 200px;
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
    <div class="container d-flex justify-content-center align-items-center my-3">
        <div class="col-md-5">
            <div class="login-card shadow text-white">
                <div class="card-body">
                    <img src="img/admin.png" class="img-fluid" alt="Doctor Image">
                    <h5 class="card-title text-center my-2">Apply Now!!</h5>

                    <div>
                        <?php echo $show; ?>
                    </div>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Firstname**</label>
                            <input type="text" name="fname" class="form-control" autocomplete="off"
                                placeholder="Enter Firstname"
                                value="<?php if (isset($_POST['fname']))
                                    echo $_POST['fname']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surname**</label>
                            <input type="text" name="sname" class="form-control" autocomplete="off"
                                placeholder="Enter Surname"
                                value="<?php if (isset($_POST['sname']))
                                    echo $_POST['sname']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username**</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off"
                                placeholder="Enter Username"
                                value="<?php if (isset($_POST['uname']))
                                    echo $_POST['uname']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email**</label>
                            <input type="email" name="email" class="form-control" autocomplete="off"
                                placeholder="Enter Email Address"
                                value="<?php if (isset($_POST['email']))
                                    echo $_POST['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Gender**</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number**</label>
                            <input type="number" name="phone" class="form-control" autocomplete="off"
                                placeholder="Enter Phone Number"
                                value="<?php if (isset($_POST['phone']))
                                    echo $_POST['phone']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Country**</label>
                            <select name="country" class="form-control">
                                <option value="">Select Country</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password**</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off"
                                placeholder="Enter password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password**</label>
                            <input type="password" name="con_pass" class="form-control" autocomplete="off"
                                placeholder="Enter confirm password">
                        </div>


                        <button type="submit" name="apply" class="btn" value="Apply Now">Apply Now</button>

                        <p> I already have an account <a href="doctorlogin.php">Click here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>