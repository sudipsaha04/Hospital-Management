<?php
class profile_image {
    private $connect;
    private $patient;

    public function __construct($connect, $patient) {
        $this->connect = $connect;
        $this->patient = $patient;
    }

    public function uploadImage($imgFile) {
        $img = $imgFile['name'];
        if(!empty($img)) {
            $query = "UPDATE patient SET profile='$img' WHERE username='$this->patient'";
            $res = mysqli_query($this->connect, $query);
            if($res) {
                move_uploaded_file($imgFile['tmp_name'], "img/$img");
            }
        }
    }
}
?>