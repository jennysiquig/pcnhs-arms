<?php
    require_once "../../../resources/config.php";
    session_start();

    if(!$conn) {
        die();
    }

    $per_id = $_POST['per_id'];
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $mname = $_POST['mname'];
    $position = $_POST['position'];
    $access_type = $_POST['access_type'];
    $accnt_status = $_POST['accnt_status'];

    $updatestmnt = "UPDATE `pcnhsdb`.`personnel` 
                    SET `uname`='$uname', `password`='$password', `last_name`='$last_name', `first_name`='$first_name', `mname`='$mname', `position`='$position', `access_type` = '$access_type',`accnt_status`='$accnt_status' 
                    WHERE personnel.per_id = '$per_id'";

    mysqli_query($conn, $updatestmnt);

    $per_edit = "EDITED PERSONNEL ACCOUNT : $per_id";
    $_SESSION['user_activity'][] = $per_edit;
    
    header("location: ../personnel_view.php?per_id=$per_id");
    
?>