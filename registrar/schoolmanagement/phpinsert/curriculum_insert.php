<?php
	$curr_id = $_POST['curr_id'];
	$curr_code = strtoupper($_POST['curr_code']);
	$curr_name = $_POST['curr_name'];
	$year_started = $_POST['year_started'];
	$year_ended = $_POST['year_ended'];

	require_once "../../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`curriculum` (`curr_id`, `curr_code`, `curr_name`, `year_started`, `year_ended`) VALUES (?, ?, ?, ?,?)");

	$statement->bind_param("issii", $curr_id, $curr_code, $curr_name, $year_started,$year_ended);

	$statement->execute();

	header('location: ../curriculum.php');

	$statement->close();
	$conn->close();
?>