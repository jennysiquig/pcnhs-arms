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
	
	$queryCheck1 = "SELECT * from personnel where per_id = ?";

    $preparedQuery1 = $conn->prepare($queryCheck1);
    $preparedQuery1->bind_param("s",$per_id);
    $preparedQuery1->execute();
    $result1 = $preparedQuery1->get_result();

    $queryCheck2 = "SELECT * from personnel where uname = ?";

    $preparedQuery2 = $conn->prepare($queryCheck2);
    $preparedQuery2->bind_param("s",$uname);
    $preparedQuery2->execute();
    $result2 = $preparedQuery2->get_result();	
   	 
   	if ($result1->num_rows > 0) {
		 $_SESSION['error_msg_personnel1'] = "Personnel ID already exists";
         die(header("Location: ../personnel_add.php"));
	}

	if ($result2->num_rows > 0) {
		 $_SESSION['error_msg_personnel2'] = "User name already exists";
         die(header("Location: ../personnel_add.php"));
	}

    else{

    $statement = $conn->prepare("INSERT INTO `pcnhsdb`.`personnel` (`per_id`, `uname`,`password`, `last_name`, `first_name`, `mname`, `position`, `access_type`, `accnt_status`) 
    							 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $statement->bind_param("sssssssss",$per_id, $uname, $password, $last_name, $first_name, $mname, $position, $access_type,$accnt_status);

    $statement->execute();

    $per_add = "ADDED PERSONNEL ACCOUNT : $per_id";
    $_SESSION['user_activity'][] = $per_add;

	header('location: ../personnels.php');

	$statement->close();
	
	$conn->close();
	}
?>