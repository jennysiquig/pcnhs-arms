<?php
	require_once "../../../resources/config.php";
	session_start();

	$sign_id = $_POST['sign_id'];
	$first_name = $_POST['first_name'];
	$mname = $_POST['mname'];
	$last_name = $_POST['last_name'];
	$title = $_POST['title'];
	$yr_started = $_POST['yr_started'];
	$yr_ended = $_POST['yr_ended'];
	$position = $_POST['position'];

	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`signatories` (`sign_id`, `last_name`, `first_name`, `mname`, `title`, `yr_started`, `yr_ended`, `position`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

	$statement->bind_param("sssssiss", $sign_id, $last_name, $first_name, $mname, $title, $yr_started, $yr_ended, $position);

	$statement->execute();

	$sign_add = "ADDED SIGNATORY : $sign_id";
    $_SESSION['user_activity'][] = $sign_add;

	header('location: ../signatories.php');

	$statement->close();
	$conn->close();
?>