<?php
	$per_id = $_POST['per_id'];
	$uname = $_POST['uname'];
	$password = $_POST['password'];
	$last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $mname = $_POST['mname'];
    $position = $_POST['position'];
    $access_type = $_POST['access_type'];
    $accnt_status = $_POST['accnt_status'];

	require_once "../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $statement = $conn->prepare("INSERT INTO `pcnhsdb`.`personnel` (`per_id`, `uname`,`password`, `last_name`, `first_name`, `mname`, `position`, `access_type`, `accnt_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $statement->bind_param("issssssss",$per_id, $uname, $password, $last_name, $first_name, $mname, $position, $access_type,$accnt_status);

    $statement->execute();

	header('location: ../index.php');

	$statement->close();
	$conn->close();
?>