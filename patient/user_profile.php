<?php
class user_profile
{
    private $patientData;

    public function __construct($patientData)
    {
        $this->patientData = $patientData;
    }

    public function displayProfile()
    {
        echo "<img src='img/" . $this->patientData['profile'] . "' style='height:250px;' class='col-md-12'>";
    }

    public function displayDetails()
    {
        echo "
        <div class='card my-3' style='background-color:  #1081c7'>
        <div class='card-header'  style=' color: white;' >
            <h5 class='text-center'>My Details</h5>
        </div>
        <div class='card-body'style=' color: white;'>
            <dl class='row'>
                <dt class='col-sm-4'>Firstname</dt>
                <dd class='col-sm-8'>{$this->patientData['firstname']}</dd>
                <dt class='col-sm-4'>Surname</dt>
                <dd class='col-sm-8'>{$this->patientData['surname']}</dd>
                <dt class='col-sm-4'>Username</dt>
                <dd class='col-sm-8'>{$this->patientData['username']}</dd>
                <dt class='col-sm-4'>Email</dt>
                <dd class='col-sm-8'>{$this->patientData['email']}</dd>
                <dt class='col-sm-4'>Phone No.</dt>
                <dd class='col-sm-8'>{$this->patientData['phone']}</dd>
                <dt class='col-sm-4'>Gender</dt>
                <dd class='col-sm-8'>{$this->patientData['gender']}</dd>
                <dt class='col-sm-4'>Country</dt>
                <dd class='col-sm-8'>{$this->patientData['country']}</dd>
            </dl>
        </div>
    </div>
        ";
    }
}
?>