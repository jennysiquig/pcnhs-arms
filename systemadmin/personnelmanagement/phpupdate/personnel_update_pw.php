<?php
require_once "../../../resources/config.php";
require_once "../bcrypt/Bcrypt.php";
include ('../../../resources/classes/Popover.php');

session_start();

if (!$conn) {
    die();
}

$per_id = htmlspecialchars($_POST['per_id'], ENT_QUOTES);
$uname = htmlspecialchars($_POST['uname'], ENT_QUOTES);
$password = htmlspecialchars($_POST['password']);
$new_password = htmlspecialchars($_POST['new_password']);
$last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
$first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
$mname = htmlspecialchars($_POST['mname'], ENT_QUOTES);
$position = htmlspecialchars($_POST['position'], ENT_QUOTES);
$access_type = htmlspecialchars($_POST['access_type'], ENT_QUOTES);
$accnt_status = htmlspecialchars($_POST['accnt_status'], ENT_QUOTES);

$pwCheck = "SELECT * from personnel where per_id = ?";
$preparedPwCheck = $conn->prepare($pwCheck);
$preparedPwCheck->bind_param("s", $per_id);
$preparedPwCheck->execute();
$resultCheckPw = $preparedPwCheck->get_result();

if ($resultCheckPw->num_rows > 0) {
    while ($row = $resultCheckPw->fetch_assoc()) {
        $verifypw = Bcrypt::checkPassword($password, $row['password']);
        if ($verifypw == TRUE) {
            $hashed = Bcrypt::hashPassword($new_password);
            $updatestmnt = "UPDATE `pcnhsdb`.`personnel` 
            SET `uname`='$uname', `password`='$hashed', `last_name`='$last_name', `first_name`='$first_name', `mname`='$mname', `position`='$position', `access_type` = '$access_type',`accnt_status`='$accnt_status' 
            WHERE personnel.per_id = '$per_id'";
            mysqli_query($conn, $updatestmnt);
            $per_edit = "EDITED PERSONNEL ACCOUNT: $per_id";
            $_SESSION['user_activity'][] = $per_edit;

            $alert_type = "info";
            $message = "Personnel Account Password Updated Successfully";
            $popover = new Popover();
            $popover->set_popover($alert_type, $message);
            $_SESSION['success_personnel_edit'] = $popover->get_popover();
            header("location: ../personnel_view.php?per_id=$per_id");
        }
        else {
            $alert_type = "danger";
            $error_message = "Cannot Edit Password: Incorrect Password";
            $popover = new Popover();
            $popover->set_popover($alert_type, $error_message);
            $_SESSION['incorrect_pw_change'] = $popover->get_popover();
            header("location: ../personnel_edit.php?per_id=$per_id");
        }
    }
}

?>
