<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	
	$prog_name = htmlspecialchars(filter_var($_POST['prog_name'], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
	$willInsert = true;
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
// Get the latest Program ID
	$prog_id = 1;
	$statement = "SELECT * FROM pcnhsdb.programs order by prog_id desc limit 1;";
	$result = $conn->query($statement);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$prog_id = $row['prog_id'];
			$prog_id = $prog_id+1;
		}
	}else {
		$prog_id = 1;
	}
	
	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`programs` (`prog_id`, `prog_name`) VALUES (?, ?)");

		$statement->bind_param("is", $prog_id, $prog_name);
	
		$statement->execute();
		$_SESSION['user_activity'][] = "Added New Program: $prog_name";
		header('location: ../student_programs.php');
	}
	

	$statement->close();
	$conn->close();



?>