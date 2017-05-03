<?php
require_once "../../../resources/config.php";
include ('../../../resources/classes/Popover.php');

session_start();

$sign_id = htmlspecialchars(filter_var($_POST['sign_id'], FILTER_SANITIZE_STRING));
$first_name = htmlspecialchars(filter_var($_POST['first_name'], FILTER_SANITIZE_STRING));
$mname = htmlspecialchars(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
$last_name = htmlspecialchars(filter_var($_POST['last_name'], FILTER_SANITIZE_STRING));
$title = htmlspecialchars($_POST['title'], FILTER_SANITIZE_STRING);
$yr_started = htmlspecialchars($_POST['yr_started'], FILTER_SANITIZE_STRING);
$yr_ended = htmlspecialchars($_POST['yr_ended'], FILTER_SANITIZE_STRING);
$position = htmlspecialchars($_POST['position'], FILTER_SANITIZE_STRING);
$insertChck = true;

if (empty($sign_id) || empty($first_name) || empty($mname) || empty($last_name) || empty($title) || empty($yr_started) || empty($year_ended) || empty($position)) {
	$insertChck = false;
	$alert_type = "danger";
	$error_message = "Cannot insert values to Database";
	$popover = new Popover();
	$popover->set_popover($alert_type, $error_message);
	$_SESSION['error_pop'] = $popover->get_popover();
	header("location" . $_SERVER["HTTP_REFERER"]);
}

$queryCheck = "SELECT * from signatories where sign_id = '$sign_id';";
$result = DB::query($queryCheck);

if (count($result) > 0) {
	$_SESSION['error_msg_signatory'] = "Signatory ID: $sign_id already exists";
	$insertChck = false;
	$alert_type = "danger";
	$error_message = "Signatory ID already existing";
	$popover = new Popover();
	$popover->set_popover($alert_type, $error_message);
	$_SESSION['error_pop'] = $popover->get_popover();
	header("location" . $_SERVER["HTTP_REFERER"]);
}
else {
	DB::insert('signatories', array(
		'sign_id' => $sign_id,
		'last_name' => $last_name,
		'first_name' => $first_name,
		'mname' => $mname,
		'title' => $title,
		'yr_started' => $yr_started,
		'yr_ended' => $yr_ended,
		'position' => $position
	));

	$sign_add = "ADDED SIGNATORY: $sign_id";
	$_SESSION['user_activity'][] = $sign_add;

	$alert_type = "success";
	$message = "Signatory Added Successfully";
	$popover = new Popover();
	$popover->set_popover($alert_type, $message);
	$_SESSION['success_signatory'] = $popover->get_popover();
	header("location: ../signatory_view.php?sign_id=$sign_id");
}

?>
