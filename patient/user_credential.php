<?php
class user_credential {
    private $connect;
    private $patient;

    public function __construct($connect, $patient) {
        $this->connect = $connect;
        $this->patient = $patient;
    }

    public function updateUsername($uname) {
        if (!empty($uname)) {
            $query = "UPDATE patient SET username='$uname' WHERE username='$this->patient'";
            $res = mysqli_query($this->connect, $query);
            if ($res) {
                $_SESSION['patient'] = $uname;
            }
        }
    }

    public function changePassword($oldPass, $newPass, $conPass) {
        $query = "SELECT * FROM patient WHERE username = '$this->patient'";
        $res = mysqli_query($this->connect, $query);
        $row = mysqli_fetch_array($res);

        if (empty($oldPass)) {
            echo "<script>alert('Enter old Password')</script>";
        } else if (empty($newPass)) {
            echo "<script>alert('Enter New Password')</script>";
        } else if ($conPass != $newPass) {
            echo "<script>alert('Both passwords do not match')</script>";
        } else if ($oldPass != $row['password']) {
            echo "<script>alert('Check the password')</script>";
        } else {
            $query = "UPDATE patient SET password='$newPass' WHERE username='$this->patient'";
            mysqli_query($this->connect, $query);
        }
    }
}
?>
