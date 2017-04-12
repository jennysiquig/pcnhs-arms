<?php
    require_once "../../../resources/config.php";
    require_once "../bcrypt/Bcrypt.php";

    include('../../../resources/classes/Popover.php');

    session_start();

    if(!$conn) {
        die();
    }

    $per_id = htmlspecialchars($_POST['per_id'], ENT_QUOTES);
    $uname = htmlspecialchars($_POST['uname'], ENT_QUOTES);
    $password = $_POST['password'];
    //$hashed_pw = htmlspecialchars($_POST['hashed_pw'], ENT_QUOTES);
    $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
    $mname = htmlspecialchars($_POST['mname'], ENT_QUOTES);
    $position = htmlspecialchars($_POST['position'], ENT_QUOTES);
    $access_type = htmlspecialchars($_POST['access_type'], ENT_QUOTES);
    $accnt_status = htmlspecialchars($_POST['accnt_status'], ENT_QUOTES);

    // CHECK DUPLICATE USERNAME
    $unameChck = $_SESSION['unameChck'];
    $unameCheck = "SELECT * from personnel where uname = ?";
    $preparedUnameCheck = $conn->prepare($unameCheck);
    $preparedUnameCheck->bind_param("s",$uname);
    $preparedUnameCheck->execute();
    $resultCheck = $preparedUnameCheck->get_result();

    //VERIFY PASSWORD
    $pwCheck = "SELECT * from personnel where uname = ? and password = ?";
    $preparedPwCheck = $conn->prepare($pwCheck);
    $preparedPwCheck->bind_param("ss",$uname,$password);
    $preparedPwCheck->execute();
    $resultCheckPw = $preparedPwCheck->get_result();
        
        if($resultCheckPw->num_rows>0) {
            while ($row=$resultCheckPw->fetch_assoc()) {
                
                //$verifypw = Bcrypt::checkPassword($password, $row['hashed_pw']);
                
                if($password != $row['password']) {

                $alert_type = "danger";
                $error_message = "Cannot Edit Account Information: Incorrect Password";
                $popover = new Popover();
                $popover->set_popover($alert_type, $error_message);
                $_SESSION['incorrect_pw'] = $popover->get_popover(); 
                header("location: ../personnel_edit.php?per_id=$per_id");
                
                }

                else{

                    if ($resultCheck->num_rows>0 && $uname != $unameChck) {
                         $_SESSION['error_msg_username_exists'] = "Username: $uname already exists";
                         $alert_type = "danger";
                         $error_message = "Personnel Username already exists";
                         $popover = new Popover();
                         $popover->set_popover($alert_type, $error_message);
                         $_SESSION['duplicate_uname'] = $popover->get_popover(); 
                         header("location: ../personnel_edit.php?per_id=$per_id");
                    }

                    else {
                    $hashed = Bcrypt::hashPassword($password);
                    $updatestmnt = "UPDATE `pcnhsdb`.`personnel` 
                                    SET `uname`='$uname', `password`='$password', `hashed_pw` = '$hashed', `last_name`='$last_name', `first_name`='$first_name', `mname`='$mname', `position`='$position', `access_type` = '$access_type',`accnt_status`='$accnt_status' 
                                    WHERE personnel.per_id = '$per_id'";

                    mysqli_query($conn, $updatestmnt);

                    $per_edit = "EDITED PERSONNEL ACCOUNT : $per_id";
                    $_SESSION['user_activity'][] = $per_edit;

                    //NOTIFICATIONS
                    $alert_type = "info";
                    $message = "Personnel Account Information Edited Successfully";
                    $popover = new Popover();
                    $popover->set_popover($alert_type, $message);   
                    $_SESSION['success_personnel_edit'] = $popover->get_popover();
                    
                    header("location: ../personnel_view.php?per_id=$per_id");
                    }
                }
            }
        }
            else{

                    $alert_type = "danger";
                    $error_message = "Cannot Edit Account Information: Incorrect Password";
                    $popover = new Popover();
                    $popover->set_popover($alert_type, $error_message);
                    $_SESSION['incorrect_pw'] = $popover->get_popover(); 
                    header("location: ../personnel_edit.php?per_id=$per_id");
            }
?>
