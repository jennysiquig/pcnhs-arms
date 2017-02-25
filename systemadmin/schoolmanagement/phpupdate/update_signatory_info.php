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

	require_once "../../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`signatories` (`sign_id`, `last_name`, `first_name`, `mname`, `yr_started`, `yr_ended`, `position`) VALUES (?, ?, ?, ?, ?, ?, ?)");

	$statement->bind_param("isssiss", $sign_id, $last_name, $first_name, $mname, $yr_started, $yr_ended, $position);

	$statement->execute();

	header('location: signatories.php');

	$statement->close();
	$conn->close();
?>