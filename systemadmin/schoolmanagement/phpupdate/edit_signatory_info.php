<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}

	$sign_id = $_POST['sign_id'];
	$first_name = $_POST['first_name'];
	$mname = $_POST['mname'];
	$last_name = $_POST['last_name'];
	$yr_started = $_POST['yr_started'];
	$yr_ended = $_POST['yr_ended'];
	$position = $_POST['position'];

	$updatestmt = "UPDATE `pcnhsdb`.`signatories` SET `first_name`='$first_name', `mname`='$mname', `last_name`='$last_name', `yr_started`='$yr_started', `yr_ended`='$yr_ended', `position`='$position' WHERE signatories.sign_id = '$sign_id'";

    mysqli_query($conn, $updatestmt);

	header("location: ../signatory_view.php?sign_id=$sign_id");

?>