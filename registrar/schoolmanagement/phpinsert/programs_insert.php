<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	
	$prog_id = intval(htmlspecialchars(filter_var($_POST['prog_id'], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8'));
	$prog_name = htmlspecialchars(filter_var($_POST['prog_name'], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
	$willInsert = true;
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if($prog_id < 1 || !is_int($prog_id)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Program ID.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`programs` (`prog_id`, `prog_name`) VALUES (?, ?)");

		$statement->bind_param("is", $prog_id, $prog_name);
	
		$statement->execute();
	
		header('location: ../student_programs.php');
	}
	

	$statement->close();
	$conn->close();



?>