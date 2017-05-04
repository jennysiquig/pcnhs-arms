<?php
require_once "../../../resources/config.php";
require_once "../bcrypt/Bcrypt.php";
include ('../../../resources/classes/Popover.php');

session_start();

$per_id = htmlspecialchars(filter_var($_POST['per_id'], FILTER_SANITIZE_STRING));
$uname = htmlspecialchars(filter_var($_POST['uname'], FILTER_SANITIZE_STRING));
$password = htmlspecialchars(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
$encrypted_pw = Bcrypt::hashPassword($password);
$last_name = htmlspecialchars(filter_var($_POST['last_name'], FILTER_SANITIZE_STRING));
$first_name = htmlspecialchars(filter_var($_POST['first_name'], FILTER_SANITIZE_STRING));
$mname = htmlspecialchars(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
$position = htmlspecialchars(filter_var($_POST['position'], FILTER_SANITIZE_STRING));
$access_type = htmlspecialchars(filter_var($_POST['access_type'], FILTER_SANITIZE_STRING));
$accnt_status = htmlspecialchars(filter_var($_POST['accnt_status'], FILTER_SANITIZE_STRING));
$insertChck = true;

if (empty($per_id) || empty($uname) || empty($last_name) || empty($first_name) || empty($mname) || empty($position) || empty($position) || empty($access_type) || empty($accnt_status) || empty($password)) {
    $insertChck = false;
    $alert_type = "danger";
    $error_message = "Cannot insert values to Database";
    $popover = new Popover();
    $popover->set_popover($alert_type, $error_message);
    $_SESSION['error_pop'] = $popover->get_popover();
    header("location" . $_SERVER["HTTP_REFERER"]);
}

$queryCheck1 = "SELECT * from personnel where per_id = '$per_id';";
$result1 = DB::query($queryCheck1);

$queryCheck2 = "SELECT * from personnel where uname = '$uname'";
$result2 = DB::query($queryCheck2);

if (count($result1) > 0) {
    $_SESSION['error_msg_personnel1'] = "Personnel ID: $per_id already exists";
    $insertChck = false;
    $alert_type = "danger";
    $error_message = "Personnel ID already exists";
    $popover = new Popover();
    $popover->set_popover($alert_type, $error_message);
    $_SESSION['error_pop'] = $popover->get_popover();
    header("location" . $_SERVER["HTTP_REFERER"]);
    die(header("Location: ../personnel_add.php"));
}

if (count($result2) > 0) {
    $_SESSION['error_msg_personnel2'] = "User name: $uname already exists";
    $insertChck = false;
    $alert_type = "danger";
    $error_message = "Username already exists";
    $popover = new Popover();
    $popover->set_popover($alert_type, $error_message);
    $_SESSION['error_pop2'] = $popover->get_popover();
    header("location" . $_SERVER["HTTP_REFERER"]);
    die(header("Location: ../personnel_add.php"));
}
else {
    DB::insert('personnel', array(
      'per_id' => $per_id,
      'uname' => $uname,
      'password' => $encrypted_pw,
      'last_name' => $last_name,
      'first_name' => $first_name,
      'mname' => $mname,
      'position' => $position,
      'access_type' => $access_type,
      'accnt_status' => $accnt_status
    ));

    $per_add = "ADDED PERSONNEL ACCOUNT: $per_id";
    $_SESSION['user_activity'][] = $per_add;

    $alert_type = "success";
    $message = "Personnel $uname Added Successfully";
    $popover = new Popover();
    $popover->set_popover($alert_type, $message);
    $_SESSION['success_personnel'] = $popover->get_popover();
    header("location: ../personnel_view.php?per_id=$per_id");
}

?>
