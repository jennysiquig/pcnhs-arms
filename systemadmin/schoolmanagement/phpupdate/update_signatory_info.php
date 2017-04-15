<?php
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	session_start();

	if(!$conn) {
		die();
	}

	$sign_id = htmlspecialchars($_POST['sign_id'], ENT_QUOTES);
	$first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
	$mname = htmlspecialchars($_POST['mname'], ENT_QUOTES);
	$last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
	$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
	$yr_started = htmlspecialchars($_POST['yr_started'], ENT_QUOTES);
	$yr_ended = htmlspecialchars($_POST['yr_ended'], ENT_QUOTES);
	$position = htmlspecialchars($_POST['position'], ENT_QUOTES);

	$updatestmt = "UPDATE `pcnhsdb`.`signatories` 
				   SET `first_name`='$first_name', `mname`='$mname', `last_name`='$last_name',`title`='$title', `yr_started`='$yr_started', `yr_ended`='$yr_ended', `position`='$position' 
				   WHERE signatories.sign_id = '$sign_id'";

    mysqli_query($conn, $updatestmt);

   	$sign_edit = "EDITED SIGNATORY: $sign_id";   
   	try { 
   		$_SESSION['user_activity'][] = $sign_edit;
   	}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			echo 'Logging out...';
	}finally {
		header("refresh: 3; url='../../../logout.php'");
		die();
	}
    $alert_type = "info";
    $message = "Signatory Information Edited Successfully";
    $popover = new Popover();
    $popover->set_popover($alert_type, $message);   
    $_SESSION['success_signatory_edit'] = $popover->get_popover();

	header("location: ../signatory_view.php?sign_id=$sign_id");

?>