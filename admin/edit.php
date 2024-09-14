<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Doctor</title>
    <style>
        body {
            background-image: url('img/doctor.jpg');
            
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
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3" style=" color: white;">Edit Doctor</h5>

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "SELECT * FROM doctors WHERE id = '$id'";
                        $res = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($res);
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-8">
                           
                            <div class="card mb-3" style="background-color:#6cd5eb ">
                                <div class="card-header bg-info text-center fw-bold">
                                    Doctor Details
                                </div>
                                <div class="card-body ">
                                    <h5>ID: <?php echo $row['id']; ?></h5>
                                    <h5>Firstname: <?php echo $row['firstname']; ?></h5>
                                    <h5>Surname: <?php echo $row['surname']; ?></h5>
                                    <h5>Username: <?php echo $row['username']; ?></h5>
                                    <h5>Email: <?php echo $row['email']; ?></h5>
                                    <h5>Phone: +<?php echo $row['phone']; ?></h5>
                                    <h5>Gender: <?php echo $row['gender']; ?></h5>
                                    <h5>Country: <?php echo $row['country']; ?></h5>
                                    <h5>Date Registered: <?php echo $row['data_reg']; ?></h5>
                                    <h5>Salary: TK<?php echo ($row['salary'] == 0) ? 6000 : $row['salary']; ?></h5>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                           
                            <div class="card mb-3" style="background-color:#3dc5e0 ">
                                <div class="card-header bg-primary text-white text-center">
                                    Update Salary
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_POST['update'])) {
                                        $salary = $_POST['salary'];
                                        $q = "UPDATE doctors SET salary = '$salary' WHERE id = '$id'";
                                        mysqli_query($connect, $q);
                                    }
                                    ?>
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Enter Doctor's Salary</label>
                                            <input type="number" name="salary" class="form-control" autocomplete="off"
                                                placeholder="Enter Doctor's Salary"
                                                value="<?php echo $row['salary']; ?>">
                                        </div>
                                        <br>
                                        <input type="submit" name="update" class="btn btn-success btn-block"
                                            value="Update Salary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="show"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>