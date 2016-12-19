<?php
	$prog_id = $_POST['prog_id'];
	$prog_name = $_POST['prog_name'];
	
	require_once "../../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`programs` (`prog_id`, `prog_name`) VALUES (?, ?)");

	$statement->bind_param("is", $prog_id, $prog_name);

	$statement->execute();

	header('location: ../student_programs.php');

	$statement->close();
	$conn->close();



?>