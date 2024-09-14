<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Dashboard</title>
    <style>
        
        body {
            background-image: url('img/1.jpg');
           
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

            font-family: Arial, sans-serif;
        }

      
        .container-fluid {
            background: rgba(0, 0, 0, 0.6);
           
        }

        .list-group-item {
            background-color: rgba(0, 0, 0, 0.6);
           
        }

        .dashboard-box {
            height: 130px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          
        }

        .dashboard-box h5 {
            margin: 0;
        }

        .dashboard-box a {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.75);

            border-radius: 12px;
        }

        .card input {
            border-radius: 0.375rem;
            border: 1px solid #198754;
        
            background-color: #f1f1f1;
        
        }

        .card button {
            border-radius: 0.375rem;
            width: 100%;
           
            max-width: 100px;
        
            padding: 0.75rem;
           
            background-color: #3299a8;
           
            color: white;
            transition: background-color 0.3s ease;
            margin: 0 auto;
           
        }

        .card button:hover {
            background-color: #3273a8;
         
        }

        .form-label {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h4 class="my-2 text-white">Patient Dashboard</h4>

                <div class="row">
                    <div class="col-md-3 my-3 bg-success mx-3 dashboard-box">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="text-white my-4">My Profile</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="profile.php"><i class="fa fa-user-circle fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 bg-warning mx-2 dashboard-box" style="height: 150px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="text-white my-4">Book Appointment</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="appointment.php"><i class="fa fa-calendar fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 bg-success mx-2 dashboard-box" style="height: 150px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="text-white my-4">My Invoice</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="receipt.php"><i class="fas fa-file-invoice-dollar fa-3x my-4"
                                        style="color: white;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['send'])) {
                    $title = $_POST['title'];
                    $message = $_POST['message'];

                    if (empty($title)) {
                        echo "<script>alert('Title is required');</script>";
                    } else if (empty($message)) {
                        echo "<script>alert('Message is required');</script>";
                    } else {
                        $query = "INSERT INTO report(title, message, username, date_send) VALUES('$title', '$message', '$user', NOW())";
                        $res = mysqli_query($connect, $query);

                        if ($res) {
                            echo "<script>alert('You have sent your report');</script>";
                        }
                    }
                }
                ?>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card text-white bg-dark">
                            <div class="card-body">
                                <h5 class="card-title text-center my-2">Send A Report</h5>
                                <form method="post">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" autocomplete="off"
                                            placeholder="Enter Title of the report">
                                    </div>

                                    <div class="mb-3">
                                        <label>Message</label>
                                        <input type="text" name="message" class="form-control" autocomplete="off"
                                            placeholder="Enter Message">
                                    </div>


                                    <button type="submit" name="send" class="btn">Send</button>
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