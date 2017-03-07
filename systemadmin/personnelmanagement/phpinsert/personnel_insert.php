<?php
	require_once "../../../resources/config.php";
	session_start();

	$per_id = $_POST['per_id'];
	$uname = $_POST['uname'];
	$password = $_POST['password'];
	$last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $mname = $_POST['mname'];
    $position = $_POST['position'];
    $access_type = $_POST['access_type'];
    $accnt_status = $_POST['accnt_status'];

	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $statement = $conn->prepare("INSERT INTO `pcnhsdb`.`personnel` (`per_id`, `uname`,`password`, `last_name`, `first_name`, `mname`, `position`, `access_type`, `accnt_status`) 
    							 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $statement->bind_param("sssssssss",$per_id, $uname, $password, $last_name, $first_name, $mname, $position, $access_type,$accnt_status);

    $statement->execute();


    $per_add = "ADDED PERSONNEL ACCOUNT : $per_id";
    $_SESSION['user_activity'][] = $per_add;

	header('location: ../personnels.php');

	$statement->close();
	$conn->close();
?>