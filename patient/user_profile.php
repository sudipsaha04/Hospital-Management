<?php
class user_profile {
    private $patientData;

    public function __construct($patientData) {
        $this->patientData = $patientData;
    }

    public function displayProfile() {
        echo "<img src='img/" . $this->patientData['profile'] . "' style='height:250px;' class='col-md-12'>";
    }

    public function displayDetails() {
        echo "
            <table class='table table-bordered'>
                <tr><th colspan='2' class='text-center'>My Details</th></tr>
                <tr><td>Firstname</td><td>{$this->patientData['firstname']}</td></tr>
                <tr><td>Surname</td><td>{$this->patientData['surname']}</td></tr>
                <tr><td>Username</td><td>{$this->patientData['username']}</td></tr>
                <tr><td>Email</td><td>{$this->patientData['email']}</td></tr>
                <tr><td>Phone No.</td><td>{$this->patientData['phone']}</td></tr>
                <tr><td>Gender</td><td>{$this->patientData['gender']}</td></tr>
                <tr><td>Country</td><td>{$this->patientData['country']}</td></tr>
            </table>
        ";
    }
}
?>
